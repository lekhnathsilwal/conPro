<?php

Route::group(['prefix'=>'department','as'=>'department.','middleware'=>'auth'],function (){

    Route::get('/register','DepartmentController@create')->name('register');
    Route::get('/show','DepartmentController@show')->name('show');
    Route::post('/register','DepartmentController@store')->name('register');
    Route::get('/edit/{id}','DepartmentController@edit')->name('edit');
    Route::post('/edit/{id}','DepartmentController@update')->name('edit');
    Route::get('/delete/{id}','DepartmentController@destroy')->name('delete');


});
