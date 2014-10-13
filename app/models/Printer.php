<?php

class Printer extends Eloquent {

	protected $table = 'printers';

	public function seat()
	{
		return $this->hasOne('Seat');
	}

	public function map()
	{
		return $this->belongsTo('Map');
	}

}