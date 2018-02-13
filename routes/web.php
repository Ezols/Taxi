<?php

function isToday() {
    return \Carbon\Carbon::now()->format("H") > 16;
}

function isTodayDate($date) {
    return \Carbon\Carbon::now()->format('Y-m-d') === $date;
}

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/applyfortaxi', 'TaxiController@applyForTaxi')->name('applyForTaxi');
Route::get('/showApplication', 'TaxiController@showApplication')->name('showApplication');
Route::post('/applyfortaxi', 'TaxiController@applyForTaxiStore')->name('applyForTaxiStore');
Route::post('/assignCars', 'TaxiController@assignCarsStore')->name('assignCarsStore');
Route::get('/showrides', 'TaxiController@showRides')->name('showRides');
Route::get('/showusers', 'TaxiController@showUsers')->name('showUsers');
Route::get('/updateuser/{id}', 'TaxiController@userForm')->name('updateUser');
Route::post('/updatefinal/{id}', 'TaxiController@userUpdate')->name('updateFinal');
Route::get('/deleteuser/{id}', 'TaxiController@deleteUser')->name('deleteUser');
Route::post('/deleteride/{id}', 'TaxiController@deleteRide')->name('deleteRide');
Route::get('/export', 'TaxiController@exportRide')->name('exportRide');
