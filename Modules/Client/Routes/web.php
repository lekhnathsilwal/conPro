<?php

Route::group(['prefix'=>'client','as'=>'client.','middleware'=>'auth'],function (){

    Route::get('/register','ClientController@create')->name('register');
    Route::get('/show','ClientController@show')->name('show');
    Route::get('/show/detail/{id}','ClientController@showDetail')->name('show.detail')->middleware('signed');
    Route::post('/register','ClientController@store')->name('register');
    Route::get('/edit/{id}','ClientController@edit')->name('edit');
    Route::post('/edit/{id}','ClientController@update')->name('edit');
    Route::get('/delete/{id}','ClientController@destroy')->name('delete');
    Route::get('/detail/remove/{id}','ClientController@detailRemove')->name('detail.remove');


});

Route::group(['prefix'=>'client','as'=>'client.','middleware'=>'auth:employee'],function (){

    Route::get('/detail/{id}','ClientController@detail')->name('detail');

});

