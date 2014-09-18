<?php

Route::get('/', 'DirectoryController@index');

Route::get('directory', 'DirectoryController@index');
Route::get('directory/search', 'DirectoryController@search');

Route::get('profile/changeseat', 'ProfileController@changeSeat');
Route::resource('profile', 'ProfileController');

Route::get('map/{map_id}/{mode}', 'MapController@show');

Route::post('map/thumbs', 'MapController@getThumbs');
Route::resource('map', 'MapController');

// Admin function routes
Route::group(['prefix' => 'admin', 'before' => 'admin'], function()
{
	Route::get('/', 'AdminController@index');
	Route::get('/userManager', 'AdminController@userManager');
	Route::get('/adminChange', 'AdminController@changeAdminStatus');
	Route::get('/content/addMap', 'AdminController@addMap');
	Route::post('/content/upload/map', 'AdminController@uploadMap');
	Route::get('/ldap/pull', 'LdapController@pull');

	Route::resource('printmgmt', 'PrinterController');

	Route::get('/get_floors', function() {
		$company_code = Input::get('company_code');
		$maps = Map::where('company_code', $company_code)->get();
		$floors = array();
		foreach($maps as $m)
		{
			$floors[] = $m->floor;
		}
		return Response::json(array_unique($floors));
	});
});

Route::group(['prefix' => 'coordinator'], function()
{
	Route::get('', 'CoordController@index');
	Route::get('/save', 'CoordController@save');
	Route::get('/undo', 'CoordController@undo');
});

Route::get('seat/{id}', 'SeatController@update');
Route::get('seat/{userId}/{mapId}/edit/{viewMode}', 'SeatController@edit');
Route::resource('seat', 'SeatController');