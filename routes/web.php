<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

//Clients
Route::post('/client/save', 'ClientController@save');
Route::get('/client/edit/{id}', 'ClientController@edit');
Route::get('/client/requests/{id}', 'ClientController@requests');
Route::post('/client/update/{id}', 'ClientController@update');
