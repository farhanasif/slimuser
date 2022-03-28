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

// Route::get('/', function () {
//     return view('welcome');
// });
//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/','Auth\LoginController@showLoginForm')->name('showLoginForm');
Route::post('/login','Auth\LoginController@login')->name('login');
Route::post('/logout','Auth\LoginController@logout')->name('logout');

Route::get('/registration','Auth\RegisterController@showRegistrationForm')->name('registration');
Route::post('/register','Auth\RegisterController@userRegister')->name('register');

Route::group(['middleware'=>'auth'],function(){
   Route::get('/dashboard','HomeController@index');
});
