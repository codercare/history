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
    return view('welcome');
});


Auth::routes();

// Route::group(['middleware'=>'guest'],function(){
//     Route::get('/login','Auth\LoginController@index');
   
 
//     Route::get('/sign-in/github', 'Auth\LoginController@github');
//     Route::get('/sign-in/github/redirect', 'Auth\LoginController@githubRedirect');

// });

Route::get('/home', 'HomeController@index')->name('home');
Route::get('auth/{provider}', 'Auth\LoginController@redireToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');


// Route::post('sociallogin/{provider}', 'Auth\AuthController@SocialSignup');
// Route::get('auth/{provider}/callback', 'OutController@index')->where('provider', '.*');

//Route::get()