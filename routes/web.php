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

Auth::routes();




Route::group(['middleware'=>'auth'],function(){
    Route::get('/', 'HomeController@index')->name('home');

    
    Route::resource('customers','CustomersController');
    Route::resource('products','ProductsController');
    Route::resource('invoices','InvoicesController');
    Route::get('invoices/print/{id}','InvoicesController@print');

    Route::any('load_customers','CustomersController@load_customers');
    Route::any('load_products','ProductsController@load_products');


});

