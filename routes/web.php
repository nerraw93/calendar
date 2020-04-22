<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'EventController@index')->name('home');

// Events route
Route::group(['prefix' => 'events'], function() {
    Route::get('dates', 'EventController@getDates')->name('events.dates');
    Route::get('fetch', 'EventController@fetch')->name('events.fetch');
    Route::post('add', 'EventController@store')->name('events.new');
});