<?php

class MapController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$maps = Map::all();

		return View::make('map/index', ['maps' => $maps]);
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

	public function test_seat()
	{
		$map = Map::find(1);
		$map->seats;

		return $map;
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$map = Map::find($id);
		$seats = $map->seats;

		return View::make('map/show', ['image' => $map->draw()->output(), 'map' => $map, 'mode' => null]);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
		//
	}

	public function showSeatChange($id)
	{
		$user = User::find($id);
		if( ! is_null($user->seat))
		{
			$map_id = $user->seat->map->id;
			$map = Map::find($map_id);
			$seats = $map->seats;
		}
		else
		{
			$map = Map::find(1);
			$seats = $map->seats;
		}

		return View::make('map/show', ['mode' => 'seatChange', 'map' => $map, 
									   'image' => $map->draw()->output(), 'user' => $user ]);
	}


}
