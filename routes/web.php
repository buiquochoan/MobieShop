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
//admin
Route::view('admin/login','admin.pages.login')->name('admin.login');
Route::post('admin/login','UserController@loginAdmin');
Route::group(['prefix' => 'admin','middleware' => 'adminMiddleware'],function(){
	Route::resource('category','CategoryController');
	Route::view('/','admin.pages.index');
	Route::resource('productType','ProductTypeController');
	Route::resource('product','ProductController');
	Route::get('ajaxProductTypeController/{idCategory}','ajaxProductTypeController@getProductType');
	Route::post('product/{id}','ProductController@update');
	Route::resource('order','OrderController');
});
//client
Route::get('/','HomeController@index');
Route::get('callback/{social}','UserController@handleProviderCallback');
Route::get('login/{social}','UserController@redirectProvider')->name('facebook.social');
Route::post('register','UserController@registerClient')->name('register');
Route::get('logout','UserController@logoutClient')->name('logout');
Route::post('login','UserController@loginClient')->name('login');
Route::resource('cart','CartController');
Route::get('addCart/{id}','CartController@addCart')->name('addCart');
Route::get('checkout','CartController@checkout');

Route::resource('customer','CustomerController');