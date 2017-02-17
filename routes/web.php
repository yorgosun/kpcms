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

Route::get('/home', 'HomeController@index');

Route::get('/sutras', 'SutraController@index');
Route::get('/sutras/create', 'SutraController@create');
Route::post('/sutras', 'SutraController@store');
Route::get('/sutras/{sutraid}', 'SutraController@show');
Route::get('/sutras/{sutraid}/edit', 'SutraController@edit');
Route::put('/sutras/{sutraid}', 'SutraController@update');


Route::get('/sutras/{sutraid}/kepans', 'KepanController@index');
Route::get('/sutras/{sutraid}/kepans/{kpid}/create', 'KepanController@create');
Route::post('/kepans', 'KepanController@store');
Route::get('/kepans/{kpid}', 'KepanController@show');
Route::get('/kepans/{kpid}/edit', 'KepanController@edit');
Route::put('/kepans/{kpid}', 'KepanController@update');
Route::delete('/kepans/{kpid}', 'KepanController@destroy');

Route::get('/kepan-preview/{sutraid}', 'KepanPreviewController@index');