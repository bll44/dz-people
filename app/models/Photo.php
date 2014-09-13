<?php

class Photo extends Eloquent {

	protected $table = 'photos';

	// retrieve the user that owns this photo
	public function User()
	{
		return $this->belongsTo('User');
	}

}