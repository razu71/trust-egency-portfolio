<?php

Route::group(['prefix' => 'admin','namespace' => 'Admin'], function (){

    //authentication
    Route::get('/','AuthController@getLogin')->name('getLogin');
    Route::get('login','AuthController@getLogin')->name('getLogin');
    Route::post('login-post','AuthController@postLogin')->name('postLogin');
    Route::post('edit-profile','AuthController@editProfile')->name('editProfile');
    Route::post('update-profile','AuthController@updateProfile')->name('updateProfile');

    Route::get('logout','AuthController@logout')->name('logout');

    //admin dashboard
    Route::get('dashboard','DashboardController@getDashboard')->name('getDashboard');

    //web cms module
    Route::get('slider','WebController@getSlider')->name('getSlider');
    Route::post('save-slider','WebController@saveSlider')->name('saveSlider');
    Route::post('edit-slider','WebController@editSlider')->name('editSlider');
    Route::get('delete-slider/{id}','WebController@deleteSlider')->name('deleteSlider');

    Route::get('gallery','WebController@getGallery')->name('getGallery');
    Route::post('save-gallery','WebController@saveGallery')->name('saveGallery');
    Route::post('edit-gallery','WebController@editGalleryImage')->name('editGalleryImage');
    Route::get('delete-gallery_image/{id}','WebController@deleteGalleryImage')->name('deleteGalleryImage');

    Route::post('edit-gallery_video','WebController@editGalleryVideo')->name('editGalleryVideo');
    Route::get('delete-gallery_video/{id}','WebController@deleteGalleryVideo')->name('deleteGalleryVideo');

    //leaflet
    Route::any('leaflet','LeafletController@getLeaflet')->name('getLeaflet');
    Route::get('leaflet/add/iframe/{id}','LeafletController@getLeafletAddIframe')->name('getLeafletAddIframe');
    Route::get('leaflet/add','LeafletController@getLeafletAdd')->name('getLeafletAdd');
    Route::get('leaflet/edit/{id}','LeafletController@getLeafletAdd')->name('getLeafletEdit');
    Route::get('leaflet/pdf/{id}','LeafletController@getLeafletPdf')->name('getLeafletPdf');
    Route::post('leaflet/save','LeafletController@getLeafletSave')->name('getLeafletSave');

    Route::get('leaflet/page/add/{id}/{page_no}/{type}','LeafletController@getLeafletPageAdd')->name('getLeafletPageAdd');
    Route::post('leaflet/page/save','LeafletController@getLeafletPageSave')->name('getLeafletPageSave');


    Route::post('product/save','ProductController@saveProduct')->name('saveProduct');

    //sms module
    Route::get('sms','SmsController@getSms')->name('getSms');
    Route::post('send-sms','SmsController@sendSms')->name('sendSms');
    Route::get('delete-sms/{id}','SmsController@deleteSms')->name('deleteSms');

    //pages
    Route::get('about','PageController@getAbout')->name('getAbout');
    Route::post('save-about','PageController@saveAbout')->name('saveAbout');

    Route::get('people','PageController@getPeople')->name('getPeople');
    Route::post('save-people','PageController@savePeople')->name('savePeople');
    Route::post('edit-people','PageController@editPeople')->name('editPeople');
    Route::get('delete-people/{id}','PageController@deletePeople')->name('deletePeople');

    Route::get('/client','PageController@getClient')->name('getClient');
    Route::post('/save-client','PageController@saveClient')->name('saveClient');
    Route::post('edit-client','PageController@editClient')->name('editClient');
    Route::get('/delete-client/{id}','PageController@deleteClient')->name('deleteClient');

    //contact
    Route::get('contact','PageController@getContact')->name('getContact');
    Route::post('contact-read','PageController@readContact')->name('readContact');

    //admin settings
    Route::get('setting','SettingController@getSetting')->name('getSetting');
    Route::post('save-setting','SettingController@saveSetting')->name('saveSetting');
});