<?php

Route::get('/', 'DirectoryController@index');

Route::get('directory', 'DirectoryController@index');
Route::get('directory/search', 'DirectoryController@search');

Route::get('profile/changeseat', 'ProfileController@changeSeat');
Route::resource('profile', 'ProfileController');

Route::resource('map', 'MapController');

Route::group(['prefix' => 'ldap'], function()
{
	Route::get('/pull', 'LdapController@pull');
});

// Admin functions' routes
Route::get('admin', 'AdminController@index');
Route::get('admin/userManager', 'AdminController@userManager');
Route::get('admin/adminChange', 'AdminController@changeAdminStatus');
Route::get('admin/cms/addMap', 'AdminController@addMap');
Route::post('admin/cms/upload/map', 'AdminController@uploadMap');

Route::group(['prefix' => 'coordinator'], function()
{
	Route::get('', 'CoordController@index');
	Route::get('/save', 'CoordController@save');
	Route::get('/undo', 'CoordController@undo');
});

Route::get('seat/{id}', 'SeatController@update');
Route::resource('seat', 'SeatController');