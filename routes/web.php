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

Route::get('/charts', function () {
    return view('charts');
});

Route::get('/issues', function () {
    return view('issues');
});

Route::get('/employee', function () {
    return view('employee');
});

Route::get('/editorgprofile', function () {
    return view('editorgprofile');
});

Route::get('/profile', function () {
    return view('profile');
});
