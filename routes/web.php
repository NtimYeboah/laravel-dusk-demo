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

Route::group(['prefix' => 'home', 'as' => 'home.'], function() {
    Route::get('', ['as' => 'index', 'uses' => 'HomeController@index']);
    Route::post('store', ['as' => 'store', 'uses' => 'HomeController@store']);
    Route::get('{contact}', ['as' => 'edit', 'uses' => 'HomeController@edit']);
    Route::put('{contact}', ['as' => 'update', 'uses' => 'HomeController@update']);
});



