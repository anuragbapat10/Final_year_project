<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


//Route::post('login', 'App\Http\Controllers\LoginController@login')->name('login');

Route::get('user/{id}', 'App\Http\Controllers\UserController@getUser')->name('user.get');
Route::post('user', 'App\Http\Controllers\UserController@updateUser')->name('login.update');
Route::delete('user/{id}', 'App\Http\Controllers\UserController@deleteUser')->name('user.delete');

Route::get('issue/{id}', 'App\Http\Controllers\IssueController@getIssue')->name('issue.get');
Route::post('issue/', 'App\Http\Controllers\IssueController@updateIssue')->name('issue.update');
Route::delete('issue/{id}', 'App\Http\Controllers\IssueController@deleteIssue')->name('issue.delete');
Route::get('allIssues', 'App\Http\Controllers\IssueController@getAllIssues')->name('allIssues.get');

Route::get('tag/{id}', 'App\Http\Controllers\TagController@getTag')->name('tag.get');
Route::post('tag/', 'App\Http\Controllers\TagController@updateTag')->name('tag.update');
Route::delete('tag/{id}', 'App\Http\Controllers\TagController@deleteTag')->name('tag.delete');

Route::get('comment/{id}', 'App\Http\Controllers\CommentController@getComment')->name('comment.get');
Route::post('comment/', 'App\Http\Controllers\CommentController@updateComment')->name('comment.update');
Route::delete('comment/{id}', 'App\Http\Controllers\CommentController@deleteComment')->name('comment.delete');
Route::get('childCommentsOf/{id}', 'App\Http\Controllers\CommentController@getChildComments')->name('childCommentsOf.get');

Route::get('organization/{id}', 'App\Http\Controllers\OrganizationController@getOrganization')->name('organization.get');
Route::post('organization/', 'App\Http\Controllers\OrganizationController@updateOrganization')->name('organization.update');
Route::delete('organization/{id}', 'App\Http\Controllers\OrganizationController@deleteOrganization')->name('organization.delete');

Route::get('organizationEmployee/{id}', 'App\Http\Controllers\OrganizationController@getOrganizationEmployees')->name('organizationEmployees.get');

Route::get('organizationIssues/{id}', 'App\Http\Controllers\OrganizationController@getOrganizationIssues')->name('organizationIssues.get');
