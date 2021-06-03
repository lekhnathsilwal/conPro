<?php


Route::group(['prefix'=>'user','as'=>'user.','middleware'=>'guest'],function () {

    Route::get('/','UserController@index')->name('home');

    Route::post('login','UserLoginController@login')->name('login');

    Route::get('/password/reset','UserLoginController@forgetPassword')->name('forget.password');

    Route::post('/password/reset/link','UserLoginController@sentPasswordLink')->name('email.password');

    Route::get('/account/password/reset/{id}','UserLoginController@resetPassword')->name('reset.password')->middleware('signed');

    Route::post('/account/password/update/{id}','UserLoginController@updatePassword')->name('password.update');

});
Route::group(['prefix'=>'user','as'=>'user.','middleware'=>'auth'],function (){

    Route::get('dashboard','DashboardController@index')->name('dashboard');

    Route::get('register','UserController@create')->name('register');

    Route::post('register','UserController@store')->name('register');

    Route::get('edit/{id}','UserController@edit')->name('edit');

    Route::post('edit/{id}','UserController@update')->name('edit');

    Route::get('logout','UserLoginController@logout')->name('logout');

    Route::get('show','UserController@show')->name('show');

    Route::get('show/{id}','UserController@show')->name('showByOrganization');

    Route::get('/detail/{id}','UserController@userDetail')->name('detail');

    Route::get('password/change','UserController@changePassword')->name('change.password');

    Route::post('password/change','UserController@updatePassword')->name('change.password');

    Route::get('/delete/{id}','UserController@destroy')->name('delete');

    Route::get('/profile/edit','UserController@editProfile')->name('edit.profile');

    Route::post('/profile/update','UserController@updateProfile')->name('update.profile');

    Route::get('/show/department/{id}','UserController@showByDepartment')->name('showBy.department');



});

Route::get('user/verification/{id}','UserController@verify')->name('user.verify')->middleware('signed');





