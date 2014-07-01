<?php

class Seat extends Eloquent {

	protected $table = 'seats';

	public $timestamps = false;

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function map()
	{
		return $this->belongsTo('Map');
	}

}