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
		$map = Map::where('company_code', Input::get('company_code'))->where('floor', Input::get('floor'))->first();

		$this->printer->name = Input::get('name');
		$this->printer->unc_path = Input::get('path');
		$this->printer->map_id = $map->id;

		if($this->printer->save())
			return $this->seatPrinter($this->printer->id, $this->printer->map->id);
	}

	public function seatPrinter($printerId, $mapId = null)
	{
		$this->printer = Printer::find($printerId);
		$map = Map::find($mapId);

		$map->drawOverview();
		$map->setAreas('printmgmt', $this->printer);
		return View::make('map.show', ['map' => $map, 'allMaps' => Map::all(), 'image' => $map->output(),
								   	   'printer' => $this->printer, 'viewMode' => 'printmgmt']);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return 'test';
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
		$this->printer = Printer::find($id);
		if(null !== ($seat = $this->printer->seat))
		{
			$seat->printer_id = null;
			$seat->save();
		}
		$this->printer->delete();
		return Redirect::route('admin.printmgmt.index');
	}


}
