<?php

class AdminController extends BaseController {

	public function index()
	{
		return View::make('admin/main', ['activePage' => 'admin']);
	}

	public function userManager()
	{
		$user = new User;
		if(null !== $query = Input::get('query'))
		{
			if($query != '')
				$users = $user->search($query, 'admin/userManager');
			else
				return Redirect::to('admin/userManager');
		}
		else
		{
			$users = User::orderBy('displayname', 'asc')->paginate(25);
		}

		return View::make('admin/userManager/main', ['users' => $users, 'query' => $query, 'activePage' => 'usermgr']);
	}

	// Ajax function
	// called when admin Yes/No toggle is changed
	public function changeAdminStatus()
	{
		$user_id = Input::get('user');
		$status = Input::get('status');

		$user = User::find($user_id);

		$admin = ($status === 'yes') ? 1 : null;
		$user->admin = $admin;
		$user->save();

		return json_encode(['message' => 'success']);
	}

	public function addMap()
	{
		return View::make('admin/content/addMap/main', ['activePage' => 'addmap']);
	}

	public function uploadMap()
	{
		if( ! Input::hasFile('map_image'))
			return Redirect::to('admin/content/addMap')->with(['status' => 0, 'message' => 'Map failed to upload']);

		if(Input::file('map_image')->isValid())
		{
			$map = new Map;
			$map->company = Input::get('company');
			$map->address = Input::get('address');
			$map->city = Input::get('city');
			$map->zip = Input::get('zip');
			$map->floor = Input::get('floor');
			$map->description = Input::get('description');
			$map->image = Input::get('image');

			$dirSegments = explode('/', $map->image);
			$fileName = array_pop($dirSegments);
			$dir = implode('/', $dirSegments);

			Input::file('map_image')->move(base_path().'/public/'.$dir, $fileName);
			$map->save();
		}

		return Redirect::to('admin/content/addMap')->with(['status' => 1, 'message' => 'Map successfully uploaded']);

	}

}