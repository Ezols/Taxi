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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/applyfortaxi', 'TaxiController@applyForTaxi')->name('applyForTaxi');
Route::get('/showrides', 'TaxiController@showRides')->name('showRides');
Route::get('/showusers', 'TaxiController@showUsers')->name('showUsers');
Route::get('/updateuser/{id}', 'TaxiController@updateUser')->name('updateUser');