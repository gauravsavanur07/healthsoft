<?php

use Illuminate\Support\Facades\Route;

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





Route::get('/new-appointment/{doctorId}/{date}','FrontendController@show')->name('create.appointment');


;


	Route::get('/doctor/create', function (){
		return view('admin.doctor.create');
	})->name('doctor.create'); 
	Route ::get('doctor', function (){
		return view('admin.doctor.index');
	})->name('doctor.index'); 
	Route ::get('doctor/edit', function (){
		return view('admin.doctor.edit');
	})->name('doctor.edit');
	Route ::get('doctor/delete', function (){
		return view('admin.doctor.delete');
	})->name('doctor.delete'); 
	

Route::resource('doctor','DoctorController'); 
Route::resource('register','RegisterController');

Route::get('/home'.'HomeController@index' )->name('home');

	





Route ::get('/dashboard', function (){
    return view('dashboard');
})->name('dashboard'); 
Route::resource('logout','LoginController'); 

Route ::get('/logout', function (){
	return view('auth.passwords.login');
})->name('logout'); 

Route ::get('/login', function (){
    return view('auth.passwords.login');
})->name('login');
Route ::get('/register', function (){
    return view('auth.passwords.register');
})->name('register');

Route ::get('/', function (){
    return view('admin.layouts.app');
});










	Route::get('/patients','PatientlistController@index')->name('patient');
	Route::get('/patients/all','PatientlistController@allTimeAppointment')->name('all.appointments');
	Route::get('/status/update/{id}','PatientlistController@toggleStatus')->name('update.status');
	Route::resource('department','DepartmentController');




Route::group(['middleware'=>['auth','doctor']],function(){

	Route::resource('appointment','AppointmentController');
	Route::post('/appointment/check','AppointmentController@check')->name('appointment.check');
	Route::post('/appointment/update','AppointmentController@updateTime')->name('update');

	Route::get('patient-today','PrescriptionController@index')->name('patients.today');

	Route::post('/prescription','PrescriptionController@store')->name('prescription');

	Route::get('/prescription/{userId}/{date}','PrescriptionController@show')->name('prescription.show');
	Route::get('/prescribed-patients','PrescriptionController@patientsFromPrescription')->name('prescribed.patients');


});


