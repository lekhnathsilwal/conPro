<?php

Route::group(['prefix'=>'group','as'=>'group.','middleware'=>'auth'],function() {

    Route::get('/register','GroupController@create')->name('register');
    Route::post('/register','GroupController@store')->name('register');
    Route::get('/show','GroupController@show')->name('show');
    Route::get('/showPermission/{id}','GroupController@showPermission')->name('permission.show');
    Route::get('/edit/{id}','GroupController@edit')->name('edit');
    Route::post('/edit/{id}','GroupController@update')->name('update');
    ROute::get('/delete/{id}','GroupController@destroy')->name('delete');


});
