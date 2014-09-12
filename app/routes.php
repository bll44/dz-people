<?php

Route::get('/', 'DirectoryController@index');

Route::get('directory', 'DirectoryController@index');
Route::get('directory/search', 'DirectoryController@search');

Route::get('profile/changeseat', 'ProfileController@changeSeat');
Route::resource('profile', 'ProfileController');

Route::resource('map', 'MapController');

// Admin functions' routes
Route::group(['prefix' => 'admin', 'before' => 'admin'], function()
{
	Route::get('/', 'AdminController@index');
	Route::get('/userManager', 'AdminController@userManager');
	Route::get('/adminChange', 'AdminController@changeAdminStatus');
	Route::get('/content/addMap', 'AdminController@addMap');
	Route::post('/content/upload/map', 'AdminController@uploadMap');
	Route::get('/ldap/pull', 'LdapController@pull');
});

Route::group(['prefix' => 'coordinator'], function()
{
	Route::get('', 'CoordController@index');
	Route::get('/save', 'CoordController@save');
	Route::get('/undo', 'CoordController@undo');
});

Route::get('seat/{id}', 'SeatController@update');
Route::resource('seat', 'SeatController');

Route::get('filesystem', function()
{
	if(File::exists('images/maps/dayzim/philadelphia'))
	{
		return 'file exists';
	}
	else
	{
		return 'file does not exist';
	}
});

Route::get('getToday', function()
{
	return LDAP::daysSinceUpdate();
});