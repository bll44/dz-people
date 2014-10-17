<?php

class Ldap {

	/* Info for Day & Zimmermann */
	protected static $server = '172.25.0.23';
	protected static $port = 389;
	protected static $rdn = 'adm_latshab';
	protected static $password = 'myDayzimpwdbl03#';
	protected static $root_dn = ['OU=Users', 'OU=1500 SG', 'OU=Philadelphia\, PA', 'OU=DZ - Corporate', 'DC=corp', 'DC=dayzim', 'DC=com'];

	/* Info for 536 N 34th Street */
	// protected static $server = '10.0.0.16';
	// protected static $port = 389;
	// protected static $rdn = 'latshab';
	// protected static $password = 'Dayzimbl3';
	// protected static $root_dn = ['OU=Users', 'OU=536N34th', 'DC=cash', 'DC=money', 'DC=com'];


	protected $conn, $bind;

	protected static $default_user_filter = '(&(objectCategory=person)(objectClass=user)(!(UserAccountControl:1.2.840.113556.1.4.803:=2)))';

	public $search;
	public $num_entries;
	public $users = array();
	public $attributes = array();

	public function __construct()
	{
		$this->conn = ldap_connect(static::$server, static::$port);
		$this->bind = ldap_bind($this->conn, static::$rdn, static::$password);
	}

	public function search($attributes = array(), $filter = null, $dn = null)
	{

		$this->attributes = $attributes;

		if(is_null($filter)) $filter = static::$default_user_filter;

		if(is_null($dn)) $dn = static::$root_dn;

		$this->search = ldap_search($this->conn, implode(',', $dn), $filter, $this->attributes);

		return $this;
	}

	public function get()
	{

		$entries = ldap_get_entries($this->conn, $this->search);

		$this->num_entries = array_shift($entries);

		$i = 0;
		foreach($entries as $e)
		{
			$user = new User;

			$count = $e['count'];
			for($x = 0; $x < $count; $x++)
			{
				$key = $entries[$i][$x];
				$value =& $entries[$i][$key][0];

				switch ($key)
				{

					case 'objectguid' :
						$value = bin2hex($value);
					break;

					case 'objectsid' :
						$value = bin2hex($value);
					break;

					case 'samaccountname' :
						$key = 'username';
					break;

					case 'mail' :
						$key = 'email';
					break;

					case 'givenname' :
						$key = 'firstname';
					break;

					case 'sn' :
						$key = 'lastname';
					break;

					case 'whencreated' :
						$key = 'start_date';
						$this->winToDate($value);
					break;

					case 'telephonenumber' :
						$key = 'phone';
						$value = preg_replace('/[^0-9]/', '', $value);
					break;

				}
				$user->{$key} = $value;
				$user->attributes[$key] = $value;
			}

			$this->users[] = $user;
			$i++;
		}

		return $this->users;
	}

	private function winToDate(&$value)
	{
		$value = substr($value, 0, 4) . '-' . substr($value, 4, 2) . '-' . substr($value, 6, 2);
	}

	public static function daysSinceUpdate()
	{
		$refresh_date = User::first()->last_refresh;
		$today = new DateTime;

		$dayGap = (strtotime($today->format('Y-m-d h:i:s')) - strtotime($refresh_date)) / (60 * 60 * 24);

		if($dayGap < 1)
		{
			return 0;
		}
		else
		{
			return round($dayGap);
		}
	}

}