<?php

use App\Http\Controllers\Admin\ProductController;
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
 Route::get('categories/{cat_id}','IndexController@categories')->name('categories.product');
 Route::get('products/{id}','ProductsController@productdetails')->name('productdetails');
 Route::get('/get-product-price','ProductsController@getprice')->name('getprice');
 


    


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
    Route::put('edit-attributes/{id}','ProductController@editAttributes')->name('editAttributes');
    Route::get('delete-attributes/{id}','ProductController@deleteAttributes')->name('deleteAttributes');
    Route::get('alternative-image/{id}','ProductController@alterImg')->name('alterImg');
    Route::Post('add-altimg/{id}','ProductController@addAltimg')->name('addAltimg');
    Route::get('delete-altimg/{id}','ProductController@deletealtimg')->name('deletealtimg');

    Route::get('update-category-status/{id}/{status}','CategoryController@updateStatus')->name('updateStatus');
    Route::get('update-banner-status/{i}/{s}','BannersController@updateStatus')->name('updatestatus');
    Route::get('update-feature-status/{i}/{s}','ProductController@featureStatus')->name('featurestatus');
    //decclare any instead of id and status argument it willl work

});



