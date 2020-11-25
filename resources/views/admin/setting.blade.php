@extends('admin.layouts.master')
@section('title','Admin - Dashboard')
@section('style')
    <style>
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav>
                    <div class="nav nav-tabs " id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab"  aria-selected="true">General Setting</a>
                        <a class="nav-item nav-link" id="nav-social-tab" data-toggle="tab" href="#nav-social" role="tab" aria-selected="true">Social Media Setting</a>
                        <a class="nav-item nav-link" id="nav-web-tab" data-toggle="tab" href="#nav-web" role="tab" aria-selected="false">Web Setting</a>
                    </div>
                </nav>
                <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-general" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form action="{{route('saveSetting')}}" method="POST" enctype="multipart/form-data" id="general_setting_form">
                            @csrf
                            <input type="hidden" name="general_setting" value="general_setting">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="company_name">Company Name</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" value="@if(!empty(setting('company_name'))) {{setting('company_name')}} @else Trust Enterprise @endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="@if(!empty(setting('email'))) {{setting('email')}} @else admin@trustenterprise.com.bd @endif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="@if(!empty(setting('address'))) {{setting('address')}} @else Bokchor Road, Jessore @endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="number" class="form-control" id="phone" name="phone" value="@if(!empty(setting('phone'))){{setting('phone')}}@else Phone @endif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="website">Website</label>
                                    <input type="url" class="form-control" id="website" name="website" value="@if(!empty(setting('website'))) {{setting('website')}} @else https://trustenterprise.com.bd @endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="year">Year</label>
                                    <input type="number" class="form-control" id="year" name="year" value="@if(!empty(setting('year'))){{setting('year')}}@else Year @endif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="api">Sms API</label>
                                    <input type="url" class="form-control" id="api" name="sms_api" value="@if(!empty(setting('sms_api'))) {{setting('sms_api')}} @else SMS API @endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="token">Sms Token</label>
                                    <input type="text" class="form-control" id="token" name="sms_token" value="@if(!empty(setting('sms_token'))){{setting('sms_token')}}@else SMS Token @endif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="logo">Logo</label>
                                    <input type="file" class="form-control" id="logo" name="logo">
                                    <span id="preview_logo">@if(!empty(setting('logo')))<img src="{{asset(LOGO_IMAGE_PATH.setting('logo'))}}" height="50px" width="50px"> @endif</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="favicon">Favicon</label>
                                    <input type="file" class="form-control" id="favicon" name="favicon">
                                    <span id="preview_favicon">@if(!empty(setting('favicon')))<img src="{{asset(FAVICON_IMAGE_PATH.setting('favicon'))}}" height="50px" width="50px"> @endif</span>
                                </div>
                            </div>

                            <input type="submit" class="btn btn-primary btn-block" value="save">
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-social" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <form action="{{route('saveSetting')}}" method="POST" enctype="multipart/form-data" id="social_setting_form">
                            @csrf
                            <input type="hidden" name="social_media_setting" value="social_media_setting">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="facebook">Facebook</label>
                                    <input type="url" class="form-control" id="facebook" name="facebook" value="@if(!empty(setting('facebook'))) {{setting('facebook')}} @else Facebook @endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="twitter">Twitter</label>
                                    <input type="url" class="form-control" id="twitter" name="twitter" value="@if(!empty(setting('twitter'))) {{setting('twitter')}} @else Twitter @endif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="google_plus">Google Plus</label>
                                    <input type="url" class="form-control" id="google_plus" name="google_plus" value="@if(!empty(setting('google_plus'))) {{setting('google_plus')}} @else Google Plus @endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="linked_in">Linked In</label>
                                    <input type="url" class="form-control" id="linked_in" name="linked_in" value="@if(!empty(setting('linked_in'))) {{setting('linked_in')}} @else Linked In @endif">
                                </div>
                            </div>

                            <input type="submit" class="btn btn-primary btn-block" value="save">
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-web" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <form action="{{route('saveSetting')}}" method="POST" enctype="multipart/form-data" id="web_setting_form">
                            @csrf
                            <input type="hidden" name="web_setting" value="web_setting">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="body_background">Body Background Color</label>
                                    <input type="color" class="form-control" id="body_background" name="body_background" value="@if(!empty(setting('body_background'))){{setting('body_background')}}@else #000 @endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nav">Nav Color</label>
                                    <input type="color" class="form-control" id="nav" name="nav" value="@if(!empty(setting('nav'))){{setting('nav')}}@else #000 @endif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="gallery">Gallery Background</label>
                                    <input type="color" class="form-control" id="gallery" name="gallery" value="@if(!empty(setting('gallery'))){{setting('gallery')}}@else #000 @endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="footer">Footer Background</label>
                                    <input type="color" class="form-control" id="footer" name="footer" value="@if(!empty(setting('footer'))){{setting('footer')}}@else #000 @endif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="footer_top">Footer Top</label>
                                    <input type="color" class="form-control" id="footer_top" name="footer_top" value="@if(!empty(setting('footer_top'))){{setting('footer_top')}}@else #000 @endif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="contact_form">Contact Form</label>
                                    <input type="color" class="form-control" id="contact_form" name="contact_form" value="@if(!empty(setting('contact_form'))){{setting('contact_form')}}@else #000 @endif">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="client_background">Client Background</label>
                                    <input type="color" class="form-control" id="client_background" name="client_background" value="@if(!empty(setting('client_background'))){{setting('client_background')}}@else #000 @endif">
                                </div>

                            </div>

                            <input type="submit" class="btn btn-primary btn-block" value="save">
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection