<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\About_us;
use App\Model\Client;
use App\Model\Contact;
use App\Model\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PageController extends Controller
{
    public function getAbout(){
        $about = About_us::get();
        return view('admin.page.about',['about' => $about]);
    }

    public function saveAbout(Request $request){
        $data = [
            'text' => $request->text,
        ];

        if ($request->id != ''){
            $about = About_us::where('id',$request->id)->first();
            if (!empty($about->image) && $request->has('image')){
                removeImage(ABOUT_US_IMAGE_PATH,$about->image);
                $data['image'] = fileUpload($request->image,ABOUT_US_IMAGE_PATH);
            }
            About_us::where('id',$request->id)->update($data);
            return redirect()->back()->with(['success' => 'About us saved successfully!']);
        }else{
            if ($request->has('image')){
                $data['image'] = fileUpload($request->image,ABOUT_US_IMAGE_PATH);
            }
            About_us::create($data);
            return redirect()->back()->with(['success' => 'About us saved successfully!']);
        }

    }

    public function getPeople(){
        $peoples = People::get();
        return view('admin.page.people',['peoples' => $peoples]);
    }

    public function savePeople(Request $request){
//        dd($request->all());

        $data = [
            'name' => $request->name,
            'designation' => $request->designation,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'google' => $request->google,
            'linkedin' => $request->linkedin,
        ];
        if (!empty($request->edit_people)){
            $people = People::where('id',$request->edit_people)->first();
            if ($request->has('image') && !empty($people->image)){
                removeImage(PEOPLE_IMAGE_PATH, $people->image);
                $data['image'] = fileUpload($request->image, PEOPLE_IMAGE_PATH);
            }
            People::where('id', $request->edit_people)->update($data);
            return redirect()->back()->with(['success' => 'People updated successfully!']);
        }else{
            if ($request->has('image')){
                $data['image'] = fileUpload($request->image, PEOPLE_IMAGE_PATH);
            }
            People::create($data);
            return redirect()->back()->with(['success' => 'People added successfully']);
        }
    }

    public function editPeople(Request $request){
        if($request->ajax()){
            $data['people'] = People::where('id', $request->id)->first();
            if (!empty($data['people']->image)){
                $data['image'] = '<img src="'. asset(PEOPLE_IMAGE_PATH.$data['people']->image) .'" width="50px" height="50px">';
            }
            return Response::json($data);
        }
    }

    public function deletePeople($id){
        if ($id != ''){
            $people = People::where('id',$id)->first();
            if(!empty($people->image)){
                removeImage(PEOPLE_IMAGE_PATH,$people->image);
            }
            $people->delete();
            return redirect()->back()->with(['success' => 'Team Member deleted successfully!!']);
        } else{
            return redirect()->back()->with(['warning' => 'Member can not be deleted!']);
        }
    }

    public function getClient(){
        $clients = Client::get();
        return view('admin.page.client',['clients' => $clients]);
    }

    public function saveClient(Request $request){
//        dd($request->all());
        $data = [
            'name' => $request->name,
            'designation' => $request->designation,
            'reviews' => $request->reviews,
        ];

        if(!empty($request->edit_client)){
            $client = Client::where('id', $request->edit_client)->first();
            if(!empty($client->image) && $request->file('image')){
                removeImage(CLIENT_IMAGE_PATH,$client->image);
                $data['image'] = fileUpload($request->image, CLIENT_IMAGE_PATH);
            }
            Client::where('id', $request->edit_client)->update($data);
            return redirect()->back()->with(['success' => 'Client updated successfully!']);
        }else{
            if($request->hasFile('image')){
                $data['image'] = fileUpload($request->image, CLIENT_IMAGE_PATH);
            }
            Client::create($data);
            return redirect()->back()->with(['success' => 'Client added successfully!!']);
        }

    }

    public function editClient(Request $request){
        if ($request->ajax()){
            $data['client'] = Client::where('id', $request->id)->first();
            if (!empty($data['client']->image)){
                $data['image'] = '<img src="'. asset(CLIENT_IMAGE_PATH.$data['client']->image) .'" width="50px" height="50px">';
            }
            return Response::json($data);
        }
    }

    public function deleteClient($id){
        if ($id != ''){
            $client = Client::where('id',$id)->first();
            if(!empty($client->image)){
                removeImage(CLIENT_IMAGE_PATH,$client->image);
            }
            $client->delete();
            return redirect()->back()->with(['success' => 'Team Member deleted successfully!!']);
        } else{
            return redirect()->back()->with(['warning' => 'Member can not be deleted!']);
        }
    }

    public function getContact(){
        $contacts = Contact::get();
        return view('admin.page.contact',['contacts' => $contacts]);
    }

    public function readContact(Request $request){
        if ($request->ajax()){
            Contact::where('id',$request->id)->update(['is_read' => READ]);
            return response()->json(['success' => true]);
        }
    }

    public function deleteContact($id){
        if($id != ''){
            Contact::where('id',$id)->first()->delete();
            return redirect()->back()->with(['success' => 'Sms deleted successfully!!']);
        }else{
            return redirect()->back()->with(['error' => 'Something went wrong!!']);
        }
    }
}
