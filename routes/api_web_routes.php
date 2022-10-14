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
//Users Login System
//Users Login System
Route::get('/addUser', 'UserController@createForm')->middleware('role:writer|admin');

Route::get('/login',function() {
    return view('users.user_login.login');
})->name('login');


Route::get('/register', 'UserController@registerPage');


Route::get('/testingroles','HomeController@testingRoles');
//Route::middleware('customAuthentication')->group(function () {
//    Route::get('/dashboard', 'HomeController@index');
//});



//Route::get('/home', 'HomeController@index')->name('home');





//Route::group(['middleware'=>['exampleMiddleware']],function(){
//    //add routes here for group middleware
//});

//Route::get(/'sometjing','homeController')->middleware('exampleMiddleWare'); //Route middleware that checks requests
