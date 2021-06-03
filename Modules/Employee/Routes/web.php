<?php
//////////////////Employee Route for User Group to create,edit and delete//////////////////////

Route::group(['prefix'=>'employee','as'=>'employee.','middleware'=>'auth'],function (){

    Route::get('/register','EmployeeController@create')->name('register');
    Route::get('/show','EmployeeController@show')->name('show');
    Route::get('/show/detail/{id}','EmployeeController@showDetail')->name('detail');
    Route::get('/show/organization/{id}','EmployeeController@showByOrganization')->name('showByOrganization');
    Route::post('/register','EmployeeController@store')->name('register');
    Route::get('/edit/{id}','EmployeeController@edit')->name('edit');
    Route::post('/edit/{id}','EmployeeController@update')->name('edit');
    Route::get('/delete/{id}','EmployeeController@destroy')->name('delete');
    Route::get('/department/show/{id}','EmployeeController@showByDepartment')->name('showBy.department');

    Route::get('/report/show','EmployeeController@showAllReport')->name('report.show.all');
    Route::get('/report/detail/{id}','EmployeeController@showDetailReport')->name('report.detail');
    Route::get('/report/delete/{id}','EmployeeController@delete')->name('report.delete');



});
////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('employee/verify/{id}','EmployeeController@verify')->name('employee.verify')->middleware('signed');

////////Employee Route for Registered Employee to create daily report and update and delete ////

Route::group(['prefix'=>'report','as'=>'report.','middleware'=>'auth:employee'],function (){

    Route::get('/register','ReportController@create')->name('register');
    Route::get('/show','ReportController@show')->name('show');
    Route::get('/detail/{id}','ReportController@detail')->name('detail');
    Route::post('/register','ReportController@store')->name('register');
    Route::get('/edit/{id}','ReportController@edit')->name('edit');
    Route::post('/edit/{id}','ReportController@update')->name('edit');
    Route::get('/delete/{id}','ReportController@destroy')->name('delete');

});

/////////////////////////////////////////////////////////////////////////////////////////////

/////////////Employee Route for employee before login////////////////////////////////////////

Route::group(['prefix'=>'employee','as'=>'employee.','middleware'=>'guest:employee'],function (){

    Route::get('/login','EmployeeLoginController@index')->name('login');
    Route::post('/login','EmployeeLoginController@login')->name('login');
    Route::get('/password/forget','EmployeeLoginController@forgetPassword')->name('forget.password');
    Route::post('/password/reset','EmployeeLoginController@emailPassword')->name('email.password');
    Route::post('/password/update/{id}','EmployeeLoginController@updatePassword')->name('update.emp.password');
    Route::get('/password/set/{id}','EmployeeLoginController@resetPassword')->name('reset.password')->middleware('signed');

});

///////////////////////////////////////////////////////////////////////////////////////////

/////////////Employee Route for after login//////////////////////////////////////////////////////

Route::group(['prefix'=>'employee','as'=>'employee.','middleware'=>'auth:employee'],function (){

    Route::get('/dashboard','EmployeeDashboardController@index')->name('dashboard');
    Route::get('/view/profile','EmployeeController@viewProfile')->name('view.profile');
    Route::get('/change/password','EmployeeController@changePassword')->name('change.password');
    Route::post('/update/password','EmployeeController@updatePassword')->name('update.password');
    Route::get('/update/profile','EmployeeController@editProfile')->name('update.profile');
    Route::post('/update/profile','EmployeeController@updateProfile')->name('update.profile');
    Route::get('/logout','EmployeeDashboardController@destroy')->name('logout');

});

/////////////////////////////////////////////////////////////////////////////////////////////
