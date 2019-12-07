<?php

Auth::routes();


Route::get('/','HomeController@index')->name('NewsletterHome');
Route::post('/','HomeController@subscribe')->name('Subscribe');



Route::prefix('NewsletterDashboard')->group(function(){
    Route::get('/','Dashboard\DashboardController@index')->name('Dashboard');

    Route::group(['middleware' => ['role:Admin']], function () {    

    Route::get('/subscribe','Dashboard\SubscribesController@index')->name('Subscribes');
    Route::get('/subscribe/sendmail/{id}','Dashboard\SubscribesController@sendmail')->name('SendSubscribesMail');
    Route::get('/subscribe/sendmails','Dashboard\SubscribesController@sendmails')->name('SendSubscribesMails');
    
    
});

});


Route::get('/newpassword/{id}','Dashboard\DashboardController@newpassword')->name('NewPassword');
Route::post('/newpassword/{id}','Dashboard\DashboardController@newpasswordpost')->name('NewPasswordPost');

Route::get('/forgetpassword','Dashboard\DashboardController@forgetpassword')->name('ForgetPassword');
Route::post('/forgetpassword','Dashboard\DashboardController@forgetpasswordpost')->name('ForgetPasswordPost');

Route::get('/myprofile','Dashboard\UsersController@myProfile')->name('MyProfile');
Route::post('/myprofile/update','Dashboard\UsersController@myProfileUpdate')->name('MyProfileUpdate');
