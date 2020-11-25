<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SmsController extends Controller
{
    public function getSms(){
        $messages = Sms::get();
        return view('admin.sms',['messages' => $messages]);
    }
    public function sendSms(Request $request){

        $rules = [
            'to' => 'required',
            'message' => 'required'
        ];

        $messages = [
            'to.required' => 'Phone no is required',
            'message.required' => 'Message is required',
        ];

        $validator = Validator::make($request->all(),$rules,$messages);
        if($validator->fails()){
          return redirect()->back()->with(['error' => 'Phone no or Message is missing!!']);
        }else{
            $url = setting('sms_api');

            $data= [
                'to' => $request->to,
                'message' => $request->message,
                'token' => setting('sms_token')
            ];
            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
            $smsresult = curl_exec($ch);
            if (substr($smsresult,0,2) == 'Ok'){
                Sms::create($data);
                return redirect()->back()->with(['success' => 'Sms Send Successfully!']);
            }else{
                return redirect()->back()->with(['error' => 'Something Went Wrong!']);
            }
        }
    }
    public function deleteSms($id){
        if($id != ''){
            Sms::where('id',$id)->first()->delete();
            return redirect()->back()->with(['success' => 'Sms deleted successfully!!']);
        }else{
            return redirect()->back()->with(['error' => 'Something went wrong!!']);
        }
    }
}
