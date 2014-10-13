<?php

class SeatController extends \BaseController {

	protected $user, $map, $printer, $conferenceRoom;

	public function __construct(User $user, Printer $printer, Map $map, ConferenceRoom $conferenceRoom)
	{
		$this->user = $user;
		$this->map = $map;
		$this->printer = $printer;
		$this->conferenceRoom = $conferenceRoom;
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
		$this->map->setAreas('seatChange', $this->user);

		$allMaps = Map::all();

		return View::make('map.show', ['user' => $this->user, 'map' => $this->map,
									   'allMaps' => $allMaps, 'image' => $this->map->output(),
									   'viewMode' => $viewMode]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($seatId, $class, $classId)
	{
		$model = $class::find($classId);

		if(null !== $model->seat)
		{
			$model->seat->{strtolower($class) . '_id'} = null;
			$model->seat->save();
		}

		$seat = Seat::find($seatId);
		$seat->{strtolower($class) . '_id'} = $classId;
		$seat->save();

		if($class === 'User')
			return Redirect::route('profile.show', $classId);

		return Redirect::to('/messages/object_moved/'.$class);
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
