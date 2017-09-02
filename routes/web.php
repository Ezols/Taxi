<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/applyfortaxi', 'TaxiController@applyForTaxi')->name('applyForTaxi');
Route::get('/showApplication', 'TaxiController@showApplication')->name('showApplication');
Route::post('/applyfortaxi', 'TaxiController@applyForTaxiStore')->name('applyForTaxiStore');
Route::get('/showrides', 'TaxiController@showRides')->name('showRides');
Route::get('/showusers', 'TaxiController@showUsers')->name('showUsers');
Route::get('/updateuser/{id}', 'TaxiController@updateUser')->name('updateUser');
Route::get('/updatefinal/{id}', 'TaxiController@updateFinal')->name('updateFinal');
Route::get('/deleteuser/{id}', 'TaxiController@deleteUser')->name('deleteUser');
