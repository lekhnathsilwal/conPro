<?php


Route::get('/', function () {
    return view('home');
})->name('app.home');

Route::get('/dms/home','HomeController@dms')->name('dms.home')->middleware('auth');

Route::get('user/manual','ManualController@index')->name('manual.index')->middleware('auth');


Route::get('user/manual','ManualController@index')->name('manual.index')->middleware('auth');

Route::post('user/manual/edit','ManualController@update')->name('manual.edit')->middleware('auth');

Route::get('user/manual/show','ManualController@show')->name('manual.show')->middleware('auth');


Route::post('/delete','CommonController@destroy')->name('data.delete')->middleware('auth');

Route::get('search/{val}','SearchController@show')->name('search.item')->middleware('auth');
