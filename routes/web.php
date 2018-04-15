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

Route::get('/', 'PageController@index');
Route::post('/loadList', 'PageController@loadList');
Route::post('/add', 'PageController@add');
Route::post('/tuhanviet_add', 'PageController@add_tuhanviet');
Route::post('/edit', 'PageController@edit');
Route::post('/update', 'PageController@update');
Route::post('/delete', 'PageController@delete');