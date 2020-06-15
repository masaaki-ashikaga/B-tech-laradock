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


Route::get('/', 'ShopController@index');

Route::group(['middleware' => ['auth']], function(){
    Route::get('/mycart', 'ShopController@myCart');
    Route::post('/mycart', 'ShopController@selectItem')->name('mycart');
    // Route::post('/mycart', 'ShopController@addMycart')->name('mycart');
    Route::post('/cartdelete', 'ShopController@deleteCart');
    Route::post('/checkout', 'ShopController@checkout');
});

//Helloページ
// Route::get('hello', 'HelloController@index');
// Route::get('hello/add', 'HelloController@add');
// Route::post('hello/add', 'HelloController@create');
// Route::get('hello/edit', 'HelloController@edit');
// Route::post('hello/edit', 'HelloController@update');
// Route::get('hello/del', 'HelloController@del');
// Route::post('hello/del', 'HelloController@remove');
// Route::get('hello/show', 'HelloController@show');

//Personページ
// Route::get('person', 'PersonController@index');
// Route::get('person/find', 'PersonController@find');
// Route::post('person/find', 'PersonController@search');
// Route::get('person/add', 'PersonController@add');
// Route::post('person/add', 'PersonController@create');
// Route::get('person/edit', 'PersonController@edit');
// Route::post('person/edit', 'PersonController@update');
// Route::get('person/del', 'PersonController@delete');
// Route::post('person/del', 'PersonController@remove');

//Boardページ
// Route::get('board', 'BoardController@index');
// Route::get('board/add', 'BoardController@add');
// Route::post('board/add', 'BoardController@create');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
