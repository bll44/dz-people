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

		return View::make('map.show', ['user' => $this->user, 'map' => $this->map, 'image' => $this->map->output()]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($seat_id, $classId, $class)
	{

		$model = $class::find($classId);

		if(null !== $model->seat)
		{
			// $model->seat->
		}

		if(null !== $this->user->seat)
		{
			$this->user->seat->user_id = null;
			$this->user->seat->save();
		}

		$seat = Seat::find($seat_id);
		$seat->user_id = $this->user->objectguid;
		$seat->save();

		return Redirect::route('profile.show', ['profile' => $this->user->objectguid]);
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
