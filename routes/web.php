<?php

use Illuminate\Support\Facades\Auth;
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
 Route::get('/','IndexController@index')->name('index');
 Route::get('categories/{cat_id}','IndexController@categories')->name('catgories');
 Route::get('products/{id}','ProductsController@productdetails')->name('productdetails');


    


Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::group(['as'=>'admin.','prefix'=>'admin','namespace'=>'Admin','middleware'=>['auth','admin']],function(){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::resource('product', 'ProductController');
    Route::resource('category', 'CategoryController');
    Route::resource('banner','BannersController');

    Route::get('update-product-status/{i}/{s}','ProductController@updateStatus')->name('updateStatus');
    Route::get('attributes/{id}','ProductController@attributes')->name('attributes');
    Route::post('add-attributes/{id}','ProductController@addAttributes')->name('addAttributes');
    Route::get('update-category-status/{id}/{status}','CategoryController@updateStatus')->name('updateStatus');
    Route::get('update-banner-status/{i}/{s}','BannersController@updateStatus')->name('updatestatus');
    //decclare any instead of id and status argument it willl work

});



