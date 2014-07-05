<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	$username = explode('\\', $_SERVER['REMOTE_USER'])[1];
	if(null === Session::get('logged_in_user'))
	{
		$user = DB::table('users')->where('username', $username)->first();

		// if user does not exist in database, block access to site.
		if(is_null($user))
		{
			$error = $_SERVER['REMOTE_USER'];
			$error .= ' is not authorized.';
			$view = View::make('errors/403')->withError($error);

			return Response::make($view);
		}

		Session::put('logged_in_user', $user);
	}
	elseif(null !== Session::get('logged_in_user'))
	{
		if(Session::get('logged_in_user') !== $username)
			$user = DB::table('users')->where('username', $username)->first();

		Session::flush();
		Session::regenerate();
		Session::put('logged_in_user', $user);
	}
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('login');
		}
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

// check if user is admin before accessing certain areas of the site
Route::filter('admin', function()
{
	if( ! Session::get('logged_in_user')->admin)
		return Redirect::to('directory');
});
