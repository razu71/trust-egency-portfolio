<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function saveProduct() {

        $rules = [
            'name' => 'required',
            'image' => 'mimes:jpg,jpeg,png',
        ];
        $messages = [
            'name' => 'Product must be required',
            'mimes' => 'Product image must be an image type(jpg, jpeg, png)',
        ];
        $validation = Validator::make($request->all(),$rules,$messages);
        if ($validation->fails()){
            return redirect()->back();
        }else{
            $data = [
                'name' => $request->name
            ];
            if (!empty($request->edit_slider)){
                $update_data = Product::where('id',$request->edit_slider)->first();

                if (!empty($update_data) && $request->file('image')){
                    removeImage(SLIDER_UPLOAD_PATH,$update_data->image);
                    $data['image'] = fileUpload($request->image,SLIDER_UPLOAD_PATH);
                }
                Product::where('id',$request->edit_slider)->update($data);
                return redirect()->back()->with('success','Slider successfully updated!');
            } else {
                if(!empty($request->file('image'))){
                    $data['image'] = fileUpload($request->image,SLIDER_UPLOAD_PATH);
                }
                Product::create($data);
                return redirect()->back()->with('success','Slider successfully added!');
            }
        }
    }
}
