<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    public function defaultRoute()
    {
        return Redirect::to('/home');
    }

	public function index()
	{
        // $places = Place::all();

        $places = Place::where('publicado', '1')->get();

		return View::make('home', array(
            'page_title' => 'Home',
            'heading_title' => 'Home',
            'selected_menu' => 'home',
            'header_title' => false,
            'places' => $places,
            'show' => 'all'
        ));
	}

    public function shops()
    {
        $places = Place::where('type', 'shop') ->where('publicado','1') ->get();

        return View::make('home', array(
            'page_title' => 'Tiendas',
            'heading_title' => 'Tiendas',
            'selected_menu' => 'home',
            'header_title' => false,
            'places' => $places,
            'show' => 'shops'
        ));
    }

    public function parkings()
    {
        $places = Place::where('type', 'parking') ->where('publicado','1') ->get();

        return View::make('home', array(
            'page_title' => 'Parking',
            'heading_title' => 'Parking',
            'selected_menu' => 'home',
            'header_title' => false,
            'places' => $places,
            'show' => 'parkings'
        ));
    }


    public function workshops()
    {
        $places=Place::where('type','workshop')->where('publicado','1') ->get();

        return View::make('home', array(
            'page_title'=>'Workshop',
            'heading_title'=>'Workshop',
            'selected_menu'=>'home',
            'header_title'=>false,
            'places'=>$places,
            'show'=>'workshops'
            ));
    }
}
