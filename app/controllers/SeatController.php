<?php

class SeatController extends \BaseController {

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
	public function edit($id, $map_id)
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
			$map = Map::find($map_id);
			$seats = $map->seats;
		}
		$maps = Map::all();

		return View::make('map/show', [ 'mode' => 'seatChange', 'map' => $map,
									    'image' => $map->draw()->output(), 'user' => $user,
									    'activePage' => 'maps', 'maps' => $maps ]);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		if(Input::has('printer'))
		{
			$seat = Seat::find($id);
			$seat->printer_id = Input::get('printer');
			$seat->save();

			$printer = Printer::find(Input::get('printer'));

			return Redirect::to('admin')->with('actionMessage', "Printer {$printer->name} added successfully");
		}

		$user_id = Input::get('user');
		$user = User::find($user_id);
		if( ! is_null($user->seat))
		{
			$user->seat->user_id = null;
			$user->seat->save();
		}

		$seat = Seat::find($id);

		$seat->user_id = $user->objectguid;
		$seat->save();

		return Redirect::to("profile/$user_id");
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
