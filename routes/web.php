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
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});
Route::get('/createorganization', function () {
    return view('createorganization');
});

Route::get('/organization/dashboard', function () {
    return view('organization/dashboard');
});

Route::get('/organization/charts', function () {
    return view('organization/charts');
});

Route::get('/organization/issues', function () {
    return view('organization/issues');
});

Route::get('/organization/employee', function () {
    return view('organization/employee');
});

Route::get('/organization/editorgprofile', function () {
    return view('organization/editorgprofile');
});

Route::get('/organization/profile', function () {
    return view('organization/profile');
});
Route::get('/user/dashboard', function () {
    return view('user/dashboard');
});
Route::get('/user/issues', function () {
    return view('user/issues');
});
Route::get('/user/organization', function () {
    return view('user/organization');
});

Route::post('login', 'App\Http\Controllers\LoginController@login')->name('login');
