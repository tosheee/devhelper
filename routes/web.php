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



Route::get('/', function () { return view('home'); })->middleware('auth');

Route::get('/home', 'HomeController@index');

Auth::routes();






/////////////////////////////////////////////////////////////////////////////////////////
//Route::get('/', function () {
//    if(Auth::check()){
  //      return Redirect::to('home');
   // }
   // return Route::get('/', function () {return view('auth.login');});
    //return Route::get('/', 'Auth\LoginController@showLoginForm');
//});



//Route::get('/', function () { return view('welcome'); });

//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
