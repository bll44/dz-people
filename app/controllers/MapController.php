<?php

class MapController extends \BaseController {

	protected $map;

	public function __construct(Map $map)
	{
		$this->map = $map;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$maps = Map::all();

		return View::make('map.index', [ 'maps' => $maps, 'activePage' => 'maps', 'mode' => 'overview' ]);
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
	public function show($id, $viewMode)
	{
		$this->map = Map::find($id);

		if($viewMode === 'overview') $this->map->drawOverview();
		$this->map->setAreas($viewMode);

		return View::make('map.show', ['map' => $this->map, 'image' => $this->map->output(), 'activePage' => 'maps']);
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


}
