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

		return View::make('admin/userManager/main', ['users' => $users, 'query' => $query]);
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
		return View::make('admin/cms/addMap/main');
	}

	public function uploadMap()
	{
		if( ! Input::hasFile('map_mage'))
		{
			return View::make('admin/cms/addMap/main');
		}
		else
		{
			return 'File successfully uploaded.';
		}
	}

}