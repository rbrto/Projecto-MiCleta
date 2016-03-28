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
	//
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

Route::filter('admin_authentication', function()
{
    if (!Entrust::hasRole('administrator') )
    {
        return Redirect::route('home');
    }
});

Route::filter('user_authentication', function()
{
    if (!Entrust::hasRole('user') )
    {
        return Redirect::route('home');
    }
});

//CREAR FILTRO DE AUTENTICACION PARA LAS TIENDAS Y TALLERES-----------------------------

Route::filter('workshop_authentication', function()
{
    if (!Entrust::hasRole('workshop') )
    {
        return Redirect::route('hello');
    }
});



Route::filter('user_authentication_login', function()
{
    // If there's not user return to login
    if (!Entrust::user())
    {
        return Redirect::route('login');
    }
    elseif (Entrust::hasRole('administrator'))
    {
        return Redirect::route('home');
    }
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

Route::Filter('guest', function()
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
