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
Route::get('/login', function () {return view('login');})->name("login");

Route::get('/register', function () {return view('register');})->name("register");

Route::get('/',"MyloginController@home")->name("home");

Route::get('/my_profile',"MyloginController@my_profile")->name("my_profile");

Route::get('/view_all',"MyloginController@view_all")->name("view_all");

Route::get("logout/{id}","MyloginController@logout")->name("logout");

Route::get("login_as_user/{id}","MyloginController@login_as_user")->name("login_as_user");

Route::post("login","MyloginController@login")->name("custom_login");

Route::post("register","MyloginController@register")->name("custom_register");
