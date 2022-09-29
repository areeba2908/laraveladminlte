<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//STORES
Route::get('/getStores','StoreController@index');

Route::get('/getStoreCustomers/{id}','StoreController@getstoreCustomers');

Route::post('/postStore','StoreController@create');

Route::put('/putStore/{slug}','StoreController@update');

Route::delete('/deleteStore/{slug}','StoreController@delete');

//CUSTOMERS
Route::get('/customers','CustomerController@index')->name('customers');
//
Route::get('/addCustomer', 'CustomerController@createForm'); //open register form
//
Route::post('/createCustomer', 'CustomerController@create'); //insert
//
Route::get('/editCustomer/{id}','CustomerController@edit'); //open form for edit
//
Route::post('/updateCustomer/{id}', 'CustomerController@update'); //update in database
//
Route::delete('/deleteCustomer/{id}','CustomerController@delete')->name('customer.delete');

//WAREHOUSES
Route::get('/getWarehouses','WarehouseController@index');

Route::post('/postWarehouse','WarehouseController@create');

Route::put('/putWarehouse/{id}','WarehouseController@update');

Route::delete('/deleteWarehouse/{id}','WarehouseController@delete');

//WAREHOUSE CATEGORIES
Route::get('/getWarehouseCategories','WarehouseCategoriesController@index');

Route::post('/postWarehouseCategories','WarehouseCategoriesController@create');

Route::put('/putWarehouseCategories/{id}','WarehouseCategoriesController@update');

Route::delete('/deleteWarehouseCategories/{id}','WarehouseCategoriesController@delete');