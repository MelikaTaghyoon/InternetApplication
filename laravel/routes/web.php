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

Route::resource('animals', 'AnimalController');
Route::resource('adoptions', 'AdoptionController')->middleware('verified');
Route::get('/adoptions/accept/{id}', 'AdoptionController@accept');
Route::get('/adoptions/reopen/{id}', 'AdoptionController@reopen');
Route::get('/adoptions/reject/{id}', 'AdoptionController@reject');
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
