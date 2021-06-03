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

Route::group(['prefix'=>'organization','as'=>'organization.','middleware'=>'auth'],function() {
    Route::get('/', 'OrganizationController@index');
    Route::get('/register','OrganizationController@create')->name('register');
    Route::post('/register','OrganizationController@store')->name('register');
    Route::get('/show','OrganizationController@show')->name('show');
    Route::get('/edit/{id}','OrganizationController@edit')->name('edit');
    Route::post('/edit/{id}','OrganizationController@update')->name('update');
    Route::get('/delete/{id}','OrganizationController@destroy')->name('delete');


});

Route::group(['prefix'=>'trash','as'=>'trash.','middleware'=>'auth'],function (){

    Route::get('/show','TrashController@index')->name('show');
    Route::get('/restore/all','TrashController@restore_all')->name('restore.all');
    Route::get('/restore/module/{module}','TrashController@restore_by_module')->name('restore.module');
    Route::get('/restore/module/data/{module}/{id}','TrashController@restore_by_module_data')->name('restore.data');
    Route::get('/delete/all/{org_id}','TrashController@delete_all')->name('delete.all');
    Route::get('/delete/module/{module}/{org_id}','TrashController@delete_by_module')->name('delete.module');
    Route::get('/delete/data/module/{module}/{id}','TrashController@delete_data')->name('delete.data');

});

Route::get('/organization/show/department/{id}','OrganizationController@getDepartment')->name('show.department');
