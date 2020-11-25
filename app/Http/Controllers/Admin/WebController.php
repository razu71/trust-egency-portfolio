<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Gallery;
use App\Model\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class WebController extends Controller
{
    public function getSlider(Request $request){
        if ($request->ajax()) {
            $data = Slider::orderBy('main_title','asc');
    
            return datatables($data)
                ->addColumn('actions', function ($item) {
                    $edit_url = 'href="#add_slider" data-id="'.$item->id.'" data-toggle="modal" id="edit"';
                    $delete_url = 'href="#delete" data-toggle="modal" class="" onclick="executeToastr('.$item->id.')"';
    
                    return '<a class="btn btn-success btn-circle btn-sm edit" '.$edit_url.'>
                    <i class="fas fa-pencil-alt"></i>
                  </a>
                  <a class="btn btn-danger btn-circle btn-sm delete" '.$delete_url.'>
                      <i class="fas fa-trash"></i>
                  </a>';
                })
                ->addColumn('image', function($item) {
                    return '<img src="'.asset(SLIDER_UPLOAD_PATH.$item->image).'" width="50" height="50">';
                })
                ->rawColumns(['image','actions'])
                ->make(true);
        }


        return view('admin.web.slider');
    }

    public function editSlider(Request $request){
        if ($request->ajax()){
            $data['slider'] = DB::table('sliders')->where('id',$request->id)->first();
            if (!empty($data['slider']->image)){
                $data['image'] = '<img src="'. asset(SLIDER_UPLOAD_PATH.$data['slider']->image) .'" width="50px" height="50px">';
            }
            return Response::json($data);
        }
    }

    public function saveSlider(Request $request){

        $rules = [
            'main_title' => 'required',
            'slider_image' => 'required',
        ];
        $messages = [
            'main_title' => 'Main tile must be required',
            'slider_image' => 'Slider image must be an image type(jpg, jpeg, png)',
        ];
        $validation = Validator::make($request->all(),$rules,$messages);

        if ($validation->fails()){
            return redirect()->back();
        }else{
            $data = [
                'main_title' => $request->main_title,
                'sub_title_one' => $request->sub_title_one,
                'sub_title_two' => $request->sub_title_two,
            ];
            if (!empty($request->edit_slider)){
                $update_data = Slider::where('id',$request->edit_slider)->first();

                if (!empty($update_data) || $request->input('slider_image')){

                    if(isset($update_data)) removeImage(SLIDER_UPLOAD_PATH,$update_data->image);


                    $data['image'] = base64FileUpload($request->slider_image,SLIDER_UPLOAD_PATH);
                }

                Slider::where('id',$request->edit_slider)->update($data);
                return redirect()->back()->with('success','Slider successfully updated!');
            }else{
                if(!empty($request->input('slider_image'))){
                    $data['image'] = base64FileUpload($request->slider_image,SLIDER_UPLOAD_PATH);
                }

                Slider::insert($data);
                return redirect()->back()->with('success','Slider successfully added!');
            }
        }

    }

    public function deleteSlider($id){
        if ($id != ''){
            $slider = Slider::where('id',$id)->first();
            if(!empty($slider->image)){
                removeImage(SLIDER_UPLOAD_PATH,$slider->image);
            }
            $slider->delete();
            return redirect()->back()->with('success','Slider deleted successfully');
        }else{
            return redirect()->back()->with('error','Slider can not be deleted');
        }
    }

    public function getGallery(){
        $galleries = Gallery::get();
        return view('admin.web.gallery',['galleries' => $galleries]);
    }

    public function saveGallery(Request $request){

        if($request->type == IMAGE){
            $rules = [
                'image' => 'mimes:jpg,jpeg,png',
            ];
            $messages = [
                'mimes' => 'Gallery image must be an image type(jpg, jpeg, png)',
            ];
            $validation = Validator::make($request->all(),$rules,$messages);
            if ($validation->fails()){
                return redirect()->back();
            }else{
                $data = [
                    'title' => $request->title,
                    'description' => $request->description,
                    'type' => $request->type,
                ];

                if (!empty($request->edit_gallery_image)){
                    $update_data = Gallery::where('id',$request->edit_gallery_image)->where('type',IMAGE)->first();

                    if (!empty($update_data) && $request->file('image')){
                        removeImage(GALLERY_IMAGE_PATH,$update_data->image);
                        $data['image'] = fileUpload($request->image,GALLERY_IMAGE_PATH);
                    }else{
                        Gallery::where('id',$request->edit_gallery_image)->where('type',IMAGE)->update($data);
                        return redirect()->back()->with('success','Gallery image successfully updated!');
                    }
                }
                if(!empty($request->file('image'))){
                    $data['image'] = fileUpload($request->image,GALLERY_IMAGE_PATH);
                }
//                dd($data);
                Gallery::create($data);
                return redirect()->back()->with('success','Image successfully added!');
            }
        }else{
            $rules = [
                'link' => 'required',
            ];
            $messages = [
                'link|required' => 'Video url must be required',
            ];
            $validation = Validator::make($request->all(),$rules,$messages);
            if ($validation->fails()){
                return redirect()->back();
            }else{
                $data = [
                    'title' => $request->title,
                    'description' => $request->description,
                    'type' => $request->type,
                    'link' => $request->link
                ];
                if ($request->edit_gallery_video){
                    Gallery::where('id',$request->edit_gallery_video)->where('type',VIDEO)->update($data);
                    return redirect()->back()->with('success','Video successfully updated!');
                }else{
                    Gallery::create($data);
                    return redirect()->back()->with('success','Video successfully added!');
                }
            }
        }
    }

    public function editGalleryImage(Request $request){
        if($request->ajax()){
            $data['gallery'] = Gallery::where('id', $request->id)->where('type', IMAGE)->first();
            if (!empty($data['gallery']->image)){
                $data['image'] = '<img src="'. asset(GALLERY_IMAGE_PATH.$data['gallery']->image) .'" width="50px" height="50px">';
            }
            return Response::json($data);
        }
    }

    public function deleteGalleryImage($id){
        if ($id != ''){
            $gallery = Gallery::where('id',$id)->where('type', IMAGE)->first();
            if(!empty($gallery->image)){
                removeImage(GALLERY_IMAGE_PATH,$gallery->image);
            }
            $gallery->delete();
            return redirect()->back()->with('success','Gallery image deleted successfully');
        }else{
            return redirect()->back()->with('error','Gallery can not be deleted');
        }
    }
    public function editGalleryVideo(Request $request){
        if($request->ajax()){
            $data['video'] = Gallery::where('id', $request->id)->where('type', VIDEO)->first();
            return Response::json($data);
        }
    }

    public function deleteGalleryVideo($id){
        if ($id != ''){
            Gallery::where('id',$id)->where('type', VIDEO)->delete();
            return redirect()->back()->with('success','Gallery video deleted successfully');
        }else{
            return redirect()->back()->with('error','Gallery can not be deleted');
        }
    }
}
