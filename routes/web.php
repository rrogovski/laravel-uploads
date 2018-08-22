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

Route::post('upload', ['as' => 'files.upload', 'uses' => 'HomeController@upload']);
Route::get('usuario/{userId}/download/{fileId}', ['as' => 'files.download', 'uses' => 'HomeController@download']);
Route::get('usuario/{userId}/remover/{fileId}', ['as' => 'files.destroy', 'uses' => 'HomeController@destroy']);
