<?php

class SeatController extends \BaseController {

	protected $user, $map;

	public function __construct(User $user, Map $map)
	{
		$this->user = $user;
		$this->map = $map;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id, $map_id, $viewMode)
	{
		$this->user = User::find($id);
		$this->map = Map::find($map_id);

		if($viewMode === 'seatChange') $this->map->drawOverview();
		$this->map->setAreas('seatChange');

		return View::make('map.show', ['user' => $user, 'map' => $this->map, 'image' => $this->map->output()]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);

		$user->seat->user_id = null;
		$user->seat->save();

		return Redirect::to("profile/{$id}");
	}



}
