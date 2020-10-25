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

    View::composer('*', function($view) { $view->with('menu', App\Node::createMenu()); });

    View::composer('*', function($view) { $view->with('nodes', App\Node::all()); });

    View::composer('*', function($view) { $view->with('children', App\Children::all()); });

    Route::get('/', function () { return view('home'); })->middleware('auth');

    Route::get('/home/', 'HomeController@index');

    Route::put('/update/{id}', 'HomeController@update');

    Route::delete('/delete/{id}', 'HomeController@destroy');

    Route::post('/new',         'HomeController@store');

    //Route::resource('home', HomeController::class);;
});