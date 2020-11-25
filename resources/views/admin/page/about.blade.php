@extends('admin.layouts.master')
@section('title','Admin - Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">About Us</h1>
        </div>

    <div class="row">
        <form class="col-md-12" action="{{route('saveAbout')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="@if(!empty($about[0])) {{$about[0]->id}} @endif" name="id">
            <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="image" name="image" readonly required>
                    <span id="image_preview">@if(!empty($about[0])) <img src="{{asset(ABOUT_US_IMAGE_PATH.$about[0]->image)}}" height="75px" width="75px"> @endif</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="about_text" class="col-sm-2 col-form-label">About Text</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control" id="about_text" name="text" rows="5" required >@if(!empty($about[0])) {{$about[0]->text}} @endif</textarea>
                </div>
            </div>
            <input type="submit" class="btn btn-primary float-right" value="Save">
        </form>
    </div>
    </div>
@endsection

@section('script')

@endsection