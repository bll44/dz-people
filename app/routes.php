<?php

Route::get('testing', function()
{

});

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

	Route::get('seat/{id}/{printerId}', 'PrinterController@updatePrinterLocation');
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

Route::group(['before' => 'admin'], function()
{
	// Route::get('coordinator', 'CoordinatorController@index');
	Route::get('coordinator/save', 'CoordinatorController@save');
	Route::get('coordinator/undo', 'CoordinatorController@undo');
	Route::resource('coordinator', 'CoordinatorController');
});

Route::get('seat/{userId}/{mapId}/edit/{viewMode}', 'SeatController@edit');
Route::get('seat/{seatId}/{class}/{classId}', 'SeatController@update');
Route::resource('seat', 'SeatController');

Route::get('/messages/{page}/{object}', 'AlertsController@show');

// Route::get('classtest', function() {
// 	$class = 'User';
// 	$model = $class::find('691956c00ff98f4a842eb0c82ea1c1bb');

// 	$model->

// 	return $model->seat;
// });