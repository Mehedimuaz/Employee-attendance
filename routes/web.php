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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function(){
    //Admin side
    Route::get('/UserList', 'UserListController@index');
    Route::get('/UpdateUser/{user_type}/{user_id}', 'UpdateUserController@index');
    Route::post('/UpdateUser', 'UpdateUserController@update');
    Route::get('/BasicSettings', 'BasicSettingsController@index');
    Route::post('/BasicSettings', 'BasicSettingsController@update');

    Route::get('/PaySalary', 'AdminHomeController@pay_salary');
    Route::get('/EmployeeList', 'EmployeeListController@index');
    Route::get('/AcceptRequest/{request_id}', 'AcceptRequestController@index');
    Route::post('/AcceptRequest', 'AcceptRequestController@update');


    //Employee Side
    Route::get('/RequestAttendance/attendance', 'RequestAttendanceController@attendance');
    Route::get('/RequestAttendance/absence', 'RequestAttendanceController@absence');
    Route::post('/RequestAttendance', 'RequestAttendanceController@update');
    Route::get('/EmployeeSettings', 'EmployeeSettingsController@index');
    Route::post('/EmployeeSettings', 'EmployeeSettingsController@update');


    //Supervisor Side
    Route::get('/AcceptAttendanceRequest', 'HandleRequestController@accept_attendance_request');
    Route::get('/CancelAttendanceRequest', 'HandleRequestController@cancel_attendance_request');
    Route::get('/MakeAttendance', 'HandleRequestController@make_attendance');
    Route::get('/MakeAbsence', 'HandleRequestController@make_absence');
    Route::get('/RevertRequest', 'HandleRequestController@revert_request');
    Route::get('/RevertAttendance', 'HandleRequestController@revert_attendance');
    Route::get('/SupervisorSettings', 'SupervisorSettingsController@index');
    Route::post('/SupervisorSettings', 'SupervisorSettingsController@update');


    Route::get('/EmployeeHome', 'EmployeeHomeController@index');
    Route::get('/AdminHome', 'AdminHomeController@index');
    Route::get('/SupervisorHome', 'SupervisorHomeController@index');

    //Test
    Route::get('/test', 'UtilityClass@get7days');

    Route::get('/home', 'HomeController@index');
});


Auth::routes();