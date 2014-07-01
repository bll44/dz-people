<?php


class DirectoryController extends BaseController {

	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function index()
	{
		$users = $this->user->orderBy('displayname', 'asc')->paginate(25);

		return View::make('directory/main', [ 'users' => $users, 'activePage' => 'directory' ]);
	}

	public function search()
	{
		$query = Input::get('query');

		$users = $this->user->search($query);

		return View::make('directory/main', [ 'users' => $users, 'query' => $query, 'activePage' => 'directory' ]);
	}

}