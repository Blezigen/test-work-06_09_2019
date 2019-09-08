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


//Route::get('/', 'HomeController@welcome');

Auth::routes();

Route::get('/', 'HomeController@welcome')->name('home');
Route::post('/', 'HomeController@welcome');
Route::get('/products', 'ProductsController@index')->name('products');
Route::get('/profile', 'ProfileController@showProfileForm');
Route::post('/profile', 'ProfileController@profile')->name('profile');
