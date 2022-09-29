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
Route::get('/getStores','StoreController@index')->name('stores.list');

Route::get('/getStoreCustomers/{id}','StoreController@getstoreCustomers');

Route::get('/getStoreWarehouses/{id}','StoreController@getStoreWarehouses');

Route::get('/addStore','StoreController@createForm')->name('stores.add');

Route::post('/createStore','StoreController@create')->name('stores.create');

Route::get('/editStore/{id}','StoreController@edit')->name('stores.edit');

Route::put('/putStore/{id}','StoreController@update')->name('stores.put');

Route::delete('/deleteStore/{id}','StoreController@delete')->name('stores.delete');

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

Route::get('/addWarehouse','WarehouseController@createForm');

Route::post('/createWarehouse','WarehouseController@create');

Route::get('/editWarehouse','WarehouseController@edit');

Route::put('/putWarehouse/{id}','WarehouseController@update');

Route::delete('/deleteWarehouse/{id}','WarehouseController@delete');


//WAREHOUSE CATEGORIES
Route::get('/getWarehouseCategories','WarehouseCategoryController@index');

Route::get('/addWarehouseCategory','WarehouseCategoryController@createForm');

Route::post('/createWarehouseCategory','WarehouseCategoryController@create');

Route::get('/editWarehouse/{id}','WarehouseCategoryController@edit');

Route::put('/putWarehouseCategory/{id}','WarehouseCategoryController@update');

Route::delete('/deleteWarehouseCategorys/{id}','WarehouseCategoryController@delete');