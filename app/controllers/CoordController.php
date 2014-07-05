<?php

class CoordController extends \BaseController {

	public function index()
	{
		$map = Map::find(1);
		$map->isMaintenance = true;

		return View::make('coordinator/main', ['map' => $map, 'activePage' => 'coordinator']);
	}

	public function save()
	{
		$seat = new Seat;

		$seat->x1 = Input::get('x1');
		$seat->y1 = Input::get('y1');
		$seat->x2 = Input::get('x2');
		$seat->y2 = Input::get('y2');
		$seat->map_id = Input::get('map_id');

		$seat->save();

		$map = Map::find($seat->map_id);
		$map->isMaintenance = true;

		$data = ['seat' => $seat, 'seat_id' => $seat->id, 'map_id' => $seat->map_id, 'map_src' => $map->draw()->output()];

		return json_encode($data);
	}

	public function undo()
	{
		$seat_id = Input::get('seat_id');

		$seat = Seat::find($seat_id);
		$seat->delete();

		$map = Map::find($seat->map_id);
		$map->isMaintenance = true;

		return json_encode(['message' => 'Successfully deleted seat ' . $seat_id, 'map_src' => $map->draw()->output()]);
	}

}