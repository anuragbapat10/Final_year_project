<?php

use App\Models\Organization;
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
    return view('user/issues', ['status' => '']);
});
Route::post('/user/issues', function () {
    return view('user/issues', ['status' => 'hi from routes']);
});
Route::get('/user/organization', function () {
    $user_id = \Illuminate\Support\Facades\Auth::user()->id;
    $user_response = \Illuminate\Support\Facades\Http::get('http://localhost:8001/api/user/' . $user_id);  
    $user = $user_response["data"];

    $issue_response = \Illuminate\Support\Facades\Http::get('http://localhost:8001/api/userIssues/' . $user_id);
    $issues = $issue_response["data"];
    
    $orgs = $user["organizations"];
    return view('user/organization', ['user' => $user, 
                                        'issues' => $issues,
                                        'orgs' => $orgs,
                                        'status' => '']);
});
Route::post('/user/organization', function () {
    $user_id = \Illuminate\Support\Facades\Auth::user()->id;
    $user_response = \Illuminate\Support\Facades\Http::get('http://localhost:8001/api/user/' . $user_id);  
    $user = $user_response["data"];

    $issue_response = \Illuminate\Support\Facades\Http::get('http://localhost:8001/api/userIssues/' . $user_id);
    $issues = $issue_response["data"];
    
    $orgs = $user["organizations"];
    if(isset($_POST['searchorg'])){
        $org_name = $_POST['organization_name'];
        $organizations = \Illuminate\Support\Facades\Http::get('http://localhost:8001/api/organization/' . explode(' ', $org_name)[0])->collect();
        if(count($organizations)>0){
            $stat = 'Organization returned';
            return view('user/organization', ['status' => $stat,
                                                'user' => $user, 
                                                'issues' => $issues,
                                                'orgs' => $orgs,
                                                'neworgs' => $organizations['data']]);
        }
        else {
            $stat = 'Organization does not exists';
            return view('user/organization', ['status' => $stat,
                                                'user' => $user, 
                                                'issues' => $issues,
                                                'orgs' => $orgs,
                                                'neworgs' => null]);
        }
    }
});

Route::post('login', 'App\Http\Controllers\LoginController@login')->name('login');

Route::get('logout', 'App\Http\Controllers\LoginController@logout')->name('logout');
