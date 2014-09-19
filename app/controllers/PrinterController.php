<?php

class PrinterController extends \BaseController {

	protected $printer;

	public function __construct(Printer $printer)
	{
		$this->printer = $printer;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$printers = Printer::all();

		return View::make('admin.printmgmt.index', ['activePage' => 'printmgmt', 'printers' => $printers]);
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
		$map = Map::where('company_code', Input::get('company'))->where('floor', Input::get('floor'))->first();

		$this->printer->name = Input::get('name');
		$this->printer->path = Input::get('path');
		$this->printer->map_id = $map->id;

		if($this->printer->save())
		{
			$map->drawOverview();
			$map->setAreas('printmgmt');
			return View::make('map.show', ['map' => $map, 'image' => $map->output(), 'printer' => $this->printer]);
		}

		// Session::put('newPrinter', $this->printer);
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
