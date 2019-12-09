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

	// User
	Route::get('/home', 'HomeController@index')->name('home');
	Route::post('/user/create', 'HomeController@register')->name('createUser');
	Route::post('/user/delete/{id}', 'HomeController@deleteUser')->name('deleteUser');
	Route::post('/user/assign-role/{id}', 'HomeController@assignRoleForUser')->name('assignRoleForUser');

	// Role
	Route::get('/role', 'RoleController@showListRoles')->name('showListRoles');
	Route::get('/role/view-create', 'RoleController@viewCreateRole')->name('viewCreateRole');
	Route::post('/role/create', 'RoleController@createRole')->name('createRole');
	Route::get('/role/view-edit/{id}', 'RoleController@viewEditRole')->name('viewEditRole');
	Route::post('/role/edit/{id}', 'RoleController@updateRole')->name('updateRole');
	Route::post('/role/delete/{id}', 'RoleController@deleteRole')->name('deleteRole');

	// Tenant
	Route::get('/tenants/view-create', 'TenantController@viewCreateTenant')->name('viewCreateTenant');
	Route::post('/tenants/create', 'TenantController@createTenant')->name('createTenant');
});
