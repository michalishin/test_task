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

Route::get('/', 'ClientController@index');
Route::get('/client', 'ClientController@index');
Route::get('/client/{client}', 'ClientController@show');
Route::post('/client', 'ClientController@store');


Route::get('/deposit/{deposit}', 'DepositController@show');
Route::post('/deposit', 'DepositController@store');
