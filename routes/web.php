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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {



    Route::get('/', function () { return view('home'); })->middleware('auth');

    Route::get('/home/', 'HomeController@index');

    Route::any('/update/{id}', 'HomeController@update');

    Route::delete('/delete/{id}', 'HomeController@destroy');

    Route::post('/new',         'HomeController@store');

    Route::resource('/notes', 'NotesController');
});