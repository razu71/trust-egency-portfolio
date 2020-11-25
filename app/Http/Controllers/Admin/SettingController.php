<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getSetting(){
        return view('admin.setting');
    }
    public function saveSetting(Request $request){
        if(!empty($request->general_setting)){
            if (!empty($request->company_name)){
                if(!empty(setting('company_name'))){
                    Setting::where(['slug' => 'company_name'])->update(['value' => $request->company_name]);
                }else{
                    Setting::create(['slug' => 'company_name','value' => $request->company_name]);
                }
            }

            if (!empty($request->email)){
                if(!empty(setting('email'))){
                    Setting::where(['slug' => 'email'])->update(['value' => $request->email]);
                }else{
                    Setting::create(['slug' => 'email','value' => $request->email]);
                }
            }

            if (!empty($request->address)){
                if(!empty(setting('address'))){
                    Setting::where(['slug' => 'address'])->update(['value' => $request->address]);
                }else{
                    Setting::create(['slug' => 'address','value' => $request->address]);
                }
            }

            if (!empty($request->phone)){
                if(!empty(setting('phone'))){
                    Setting::where(['slug' => 'phone'])->update(['value' => $request->phone]);
                }else{
                    Setting::create(['slug' => 'phone','value' => $request->phone]);
                }
            }
            if (!empty($request->sms_api)){
                if(!empty(setting('sms_api'))){
                    Setting::where(['slug' => 'sms_api'])->update(['value' => $request->sms_api]);
                }else{
                    Setting::create(['slug' => 'sms_api','value' => $request->sms_api]);
                }
            }
            if (!empty($request->sms_token)){
                if(!empty(setting('sms_token'))){
                    Setting::where(['slug' => 'sms_token'])->update(['value' => $request->sms_token]);
                }else{
                    Setting::create(['slug' => 'sms_token','value' => $request->sms_token]);
                }
            }

            if (!empty($request->website)){
                if(!empty(setting('website'))){
                    Setting::where(['slug' => 'website'])->update(['value' => $request->website]);
                }else{
                    Setting::create(['slug' => 'website','value' => $request->website]);
                }
            }

            if (!empty($request->year)){
                if(!empty(setting('year'))){
                    Setting::where(['slug' => 'year'])->update(['value' => $request->year]);
                }else{
                    Setting::create(['slug' => 'year','value' => $request->year]);
                }
            }

            if (!empty($request->logo)){
                if(!empty(setting('logo'))){
                    removeImage(LOGO_IMAGE_PATH, setting('logo'));
                    $logo = fileUpload($request->logo, LOGO_IMAGE_PATH);
                    Setting::where(['slug' => 'logo'])->update(['value' => $logo]);
                }else{
                    $logo = fileUpload($request->logo,LOGO_IMAGE_PATH);
                    Setting::create(['slug' => 'logo','value' => $logo]);
                }
            }

            if (!empty($request->favicon)){
                if(!empty(setting('favicon'))){
                    removeImage(FAVICON_IMAGE_PATH, setting('favicon'));
                    $favicon = fileUpload($request->favicon, FAVICON_IMAGE_PATH);
                    Setting::where(['slug' => 'favicon'])->update(['value' => $favicon]);
                }else{
                    $favicon = fileUpload($request->favicon, FAVICON_IMAGE_PATH);
                    Setting::create(['slug' => 'favicon','value' => $favicon]);
                }
            }

            return redirect()->back()->with(['success' => 'Setting saved successfully!']);
        }

        if(!empty($request->social_media_setting)){
            if (!empty($request->facebook)){
                if(!empty(setting('facebook'))){
                    Setting::where(['slug' => 'facebook'])->update(['value' => $request->facebook]);
                }else{
                    Setting::create(['slug' => 'facebook','value' => $request->facebook]);
                }
            }

            if (!empty($request->twitter)){
                if(!empty(setting('twitter'))){
                    Setting::where(['slug' => 'twitter'])->update(['value' => $request->twitter]);
                }else{
                    Setting::create(['slug' => 'twitter','value' => $request->twitter]);
                }
            }

            if (!empty($request->google_plus)){
                if(!empty(setting('google_plus'))){
                    Setting::where(['slug' => 'google_plus'])->update(['value' => $request->google_plus]);
                }else{
                    Setting::create(['slug' => 'google_plus','value' => $request->google_plus]);
                }
            }

            if (!empty($request->linked_in)){
                if(!empty(setting('linked_in'))){
                    Setting::where(['slug' => 'linked_in'])->update(['value' => $request->linked_in]);
                }else{
                    Setting::create(['slug' => 'linked_in','value' => $request->linked_in]);
                }
            }
            return redirect()->back()->with(['success' => 'Social Media saved successfully!']);
        }

        if(!empty($request->web_setting)){
            if (!empty($request->body_background)){
                if(!empty(setting('body_background'))){
                    Setting::where(['slug' => 'body_background'])->update(['value' => $request->body_background]);
                }else{
                    Setting::create(['slug' => 'body_background','value' => $request->body_background]);
                }
            }
            if (!empty($request->nav)){
                if(!empty(setting('nav'))){
                    Setting::where(['slug' => 'nav'])->update(['value' => $request->nav]);
                }else{
                    Setting::create(['slug' => 'nav','value' => $request->nav]);
                }
            }
            if (!empty($request->gallery)){
                if(!empty(setting('gallery'))){
                    Setting::where(['slug' => 'gallery'])->update(['value' => $request->gallery]);
                }else{
                    Setting::create(['slug' => 'gallery','value' => $request->gallery]);
                }
            }
            if (!empty($request->footer)){
                if(!empty(setting('footer'))){
                    Setting::where(['slug' => 'footer'])->update(['value' => $request->footer]);
                }else{
                    Setting::create(['slug' => 'footer','value' => $request->footer]);
                }
            }
            if (!empty($request->footer_top)){
                if(!empty(setting('footer_top'))){
                    Setting::where(['slug' => 'footer_top'])->update(['value' => $request->footer_top]);
                }else{
                    Setting::create(['slug' => 'footer_top','value' => $request->footer_top]);
                }
            }
            if (!empty($request->contact_form)){
                if(!empty(setting('contact_form'))){
                    Setting::where(['slug' => 'contact_form'])->update(['value' => $request->contact_form]);
                }else{
                    Setting::create(['slug' => 'contact_form','value' => $request->contact_form]);
                }
            }
            if (!empty($request->client_background)){
                if(!empty(setting('client_background'))){
                    Setting::where(['slug' => 'client_background'])->update(['value' => $request->client_background]);
                }else{
                    Setting::create(['slug' => 'client_background','value' => $request->client_background]);
                }
            }
            return redirect()->back()->with(['success' => 'Web Setting saved successfully!']);
        }
    }
}
