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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/logout', 'HomeController@logout')->name('logout');
	Route::get('/home', 'HomeController@index')->name('home');

	Route::post('/user/create', 'HomeController@register')->name('createUser');
	Route::post('/user/delete/{id}', 'HomeController@deleteUser')->name('deleteUser');
});
