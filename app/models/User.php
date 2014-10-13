<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	protected $primaryKey = 'objectguid';

	public $incrementing = false;

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public $attributes = array();

	public function getIdAttribute()
	{
		return $this->objectguid;
	}

	public function checkExistence()
	{
		if( ! is_null(User::find($this->objectguid)))
		{
			$this->exists = true;
			return true;
		}

		return false;
	}

	public function seat()
	{
		return $this->hasOne('Seat');
	}

	public function updateRecord()
	{

		$updated = DB::table($this->table)
							    ->where('objectguid', $this->objectguid)
							    ->update([
									'username' => $this->username,
									'email' => $this->email,
									'firstname' => $this->firstname,
									'lastname' => $this->lastname,
									'displayname' => $this->displayname
								]);

		return $this;
	}

	public function search($query)
	{
		if(strlen($query) < 1) return Redirect::to('directory');

		$columns = ['displayname', 'lastname', 'firstname', 'username'];

		$terms = explode(' ', $query);

		$sth = DB::table('users');
		foreach($columns as $column)
		{
			foreach($terms as $term)
			{
				$sth->orWhere($column, 'LIKE', $term.'%');
			}
		}

		return $sth->orderBy('displayname')->paginate(25);
	}

	// retrieve profile picture
	public function photo()
	{
		return $this->hasOne('Photo');
	}
}
