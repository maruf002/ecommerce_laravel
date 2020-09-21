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

//  Route::get('/', function () {
//       return view('welcome');
//  });
 Route::get('/','IndexController@index');


    


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']],function(){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::resource('product', 'ProductController');
    Route::resource('category', 'CategoryController');
    Route::get('update-product-status/{i}/{s}','ProductController@updateStatus')->name('updateStatus');
    Route::get('update-category-status/{id}/{status}','CategoryController@updateStatus')->name('updateStatus');
    //decclare any instead of id and status argument it willl work

});



