<?php

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider
| with the tenancy and web middleware groups. Good luck!
|
*/

Route::prefix('app')->group(function () {
	Route::get('/', function () {
		return redirect()->route('login');
	});

	Auth::routes();

	Route::get('/home', 'HomeController@index')->name('home')->middleware('tenancy');
	// Route::get('/complete-registration', 'Auth\RegisterController@completeRegistration');

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
	});
});