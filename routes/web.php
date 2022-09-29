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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return view('auth.login');
});


//USERS
Route::get('/users','UserController@index')->name('users');

Route::get('/addUser', 'UserController@createForm'); //open register form

Route::post('/createUser', 'UserController@create'); //insert

Route::get('/editUser/{id}','UserController@edit'); //open form for edit

Route::post('/updateUser/{id}', 'UserController@update'); //update in database

Route::get('/deleteUser/{id}','UserController@delete');  //permanent delete


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
Route::delete('/deleteCustomer/{id}','CustomerController@delete')->name('customer.delete');  //permanent delete



//practice routes
Route::get('/editTwoCustomer/{id}','CustomerController@editTwo'); //open form for edit
//
Route::post('/updateTwoCustomer/{id}', 'CustomerController@updateTwo');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
