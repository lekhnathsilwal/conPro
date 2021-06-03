<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'project','as'=>'project.','middleware'=>'auth'],function (){

    Route::get('/register','AgreementController@create')->name('register');
    Route::get('/show','AgreementController@show')->name('show');
    Route::get('/show/{id}','AgreementController@show')->name('showByOrganization');
    Route::post('/register','AgreementController@store')->name('register');
    Route::get('/detail/{id}','AgreementController@projectDetail')->name('detail')->middleware('signed');
    Route::get('/edit/{id}','AgreementController@edit')->name('edit');
    Route::post('/edit/{id}','AgreementController@update')->name('edit');
    Route::get('/client/delete/{id}','AgreementController@clientDelete')->name('client.remove');
    Route::get('/delete/{id}','AgreementController@destroy')->name('delete');
    Route::get('/report/show/','AgreementController@generateReport')->name('report');
    Route::get('/update/status/{id}','AgreementController@updateStatus')->name('status.update');

});

Route::group(['prefix'=>'project','as'=>'file.','middleware'=>'auth'],function (){

    Route::get('/download/{id}','FileController@download')->name('download');
    Route::get('/upload/{id}','FileController@create')->name('upload');
    Route::post('/upload/{id}','FileController@store')->name('upload');
    Route::get('/file/delete/{id}','FileController@destroy')->name('delete');

});
