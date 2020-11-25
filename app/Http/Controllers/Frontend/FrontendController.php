<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\About_us;
use App\Model\Client;
use App\Model\Contact;
use App\Model\Gallery;
use App\Model\People;
use App\Model\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $data['sliders'] = Slider::get();
        $data['galleries'] = Gallery::get()->take(10);
        $data['about'] = About_us::get();
        $data['people'] = People::get();
        $data['clients'] = Client::get();
        return view('frontend.index',$data);
    }
    public function saveContact(Request $request){
        if ($request->ajax()){
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'number' => $request->number,
                'subject' => $request->subject,
                'message' => $request->message,
            ];
            Contact::create($data);
            return response()->json(['success' => true]);
        }

    }
}
