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

Route::get('add','ShoeController@create');
Route::post('add','ShoeController@store');
Route::get('shoe','ShoeController@index');
Route::get('shoe2','ShoeController@index2');
Route::get('shoecount','ShoeController@count');
Route::get('edit/{id}','ShoeController@edit');
Route::post('edit/{id}','ShoeController@update');
Route::delete('{id}','ShoeController@destroy');
