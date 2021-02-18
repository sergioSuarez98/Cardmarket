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

Route::get('/', function () {
    return view('index');
});

Route::get('/registro', function () {
    return view('signup');
});
Route::get('/inicio', function () {
    return view('index');
});
Route::get('/data', function () {
    return view('data');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/restore', function () {
    return view('restorePasswrod');
});
Route::get('/search', function () {
    return view('searchCard');
});

Route::get('/hola', function () {
    return view('hola');
});


Route::get('/no-authorized', function () {
    return "Que te follen";
});
//Route::post('/user','AjaxController@user');
Route::get('ajax',function() {
   return view('message');
});

