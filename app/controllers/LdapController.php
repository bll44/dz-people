<?php

class LdapController extends BaseController {

	protected $ldap;

	public function __construct(Ldap $ldap)
	{
		$this->ldap = $ldap
;	}

	public function pull()
	{
		$users = $this->ldap->search([
			'objectguid', 'samaccountname', 'mail', 'title',
			'sn', 'givenname', 'displayname', 'department',
			'company', 'whencreated', 'telephonenumber'
		])->get();

		foreach($users as $user)
		{
			$user->checkExistence();
			$user->save();
		}

		$date = new DateTime;
		DB::table('users')->update(['last_refresh' => $date->format('Y-m-d h:i:s')]);

		return View::make('ldap.display', ['users' => $users]);

	}

}