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

Route::get('/admin', function () {
    return view('admin.pages.index');
});
Route::get('/','HomeController@index');
Route::group(['prefix' => 'admin'],function(){
	Route::resource('category','CategoryController');
	Route::resource('productType','ProductTypeController');
	Route::resource('product','ProductController');
	Route::get('ajaxProductTypeController/{idCategory}','ajaxProductTypeController@getProductType');
	Route::post('product/{id}','ProductController@update');
});
Route::get('callback/{social}','UserController@handleProviderCallback');
Route::get('login/{social}','UserController@redirectProvider')->name('facebook.social');
Route::post('register','UserController@registerClient')->name('register');
Route::get('logout','UserController@logoutClient')->name('logout');
Route::post('login','UserController@loginClient')->name('login');