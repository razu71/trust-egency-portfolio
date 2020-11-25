<?php 

Route::group(['namespace' => 'Frontend'], function (){
    Route::get('/', 'FrontendController@index')->name('home');
    Route::post('save-contact', 'FrontendController@saveContact')->name('saveContact');
});
//Route::get('/',
////    function () {
////    return view('frontend.index');
////})->name('home');

//Route::get('/blog', function () {
//    return view('frontend.blog');
//})->name('blog');
//
//Route::get('/contact', function () {
//    return view('frontend.contact');
//})->name('contact');
