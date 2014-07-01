<?php

class LdapController extends BaseController {

	protected $ldap;

	public function __construct(Ldap $ldap)
	{
		$this->ldap = $ldap;
	}

	public function pull()
	{

		$users = $this->ldap->search([
			'objectguid', 'samaccountname', 'mail', 'title',
			'sn', 'givenname', 'displayname', 'department',
			'company', 'whencreated'
		])->get();
		
		foreach($users as $user)
		{

			$user->checkExistence();
			$user->save();
			
		}

		return View::make('ldap.display', ['users' => $users]);

	}

}