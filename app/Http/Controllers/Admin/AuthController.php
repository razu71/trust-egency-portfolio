<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getLogin(){
        return view('admin.login');
    }

    public function postLogin(Request $request){
        $credentials = $request->only('email', 'password');

        $user = User::where('email',$request->email)->first();

        if (Auth::attempt($credentials)) {
            if ($user->type == ADMIN){
                return redirect()->route('getDashboard')->with(['success' => 'Logged in successful!']);
            }
        } else{
            return redirect()->back()->with(['error' => 'Wrong Email or Password!']);
        }
    }

    public function editProfile(Request $request){
        if ($request->ajax()){
            $data['profile'] = User::where('id', $request->id)->first();
            if (!empty($data['profile']->image)){
                $data['image'] = '<img src="'. asset(PROFILE_IMAGE_PATH.$data['profile']->image) .'" width="50px" height="50px">';
            }
            return response()->json($data);
        }
    }

    public function updateProfile(Request $request){
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        $user = User::where(['email' => $request->email])->first();

        if ($request->hasFile('image') && !empty($user->image)){
            removeImage(PROFILE_IMAGE_PATH,$user->image);
            $data['image'] = fileUpload($request->image,PROFILE_IMAGE_PATH);
        }
        if (!empty($request->password)){
            $data['password'] = Hash::make($request->password);
        }
        User::where(['email' => $request->email])->update($data);
        return redirect()->back()->with(['success' => 'Profile Updated Successfully']);
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('getLogin')->with(['success' => 'Logged out successful!']);
    }
}
