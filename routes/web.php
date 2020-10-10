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

View::composer('*', function($view) { $view->with('menu', App\Node::createMenu()); });

View::composer('*', function($view) { $view->with('nodes', App\Node::all()); });

View::composer('*', function($view) { $view->with('children', App\Children::all()); });

Route::get('/', function () { return view('home'); })->middleware('auth');




Route::get('/home', 'HomeController@index');

Route::get('/create', 'HomeController@create');

//Route::resource('create', HomeController::class);





#Route::post('/create', 'HomeController@create');

//Route::post('home/create/{id?}', function($id = null) {
    //$subCategoryAttributes = App\Admin\SubCategory::where('category_id', $id)->get();
    //$subCategoryOptions = array();
    //foreach($subCategoryAttributes as $key => $subCatAttribute)
    //{
       // $subCategoryOptions[$key] = [$subCatAttribute->id, $subCatAttribute->name, $subCatAttribute->identifier];
    //}

    //return $subCategoryOptions;
//});




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
