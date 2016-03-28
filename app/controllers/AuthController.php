<?php

class AuthController extends BaseController {

    public function index(){

        if (Auth::check())
            return Redirect::to('/home');

        return View::make('login', array('page_title' => 'Login'));
    }

    public function signup(){

        return View::make('signup', array('page_title' => 'Registro'));
    }

    public function register()
    {
        $reglas = array(
            'nombre' => array('required', 'max:100'),
            'apellido' => array('required', 'max:100'),
            'alias' => array('required', 'max:100'),
            'email' => array('required', 'email', 'unique:users,email'),
            'direccion' => array('required', 'max:100'),
            'edad' => array('required', 'max:100'),
            'password' => array('required', 'max:100')
        );

        $validation = Validator::make( Input::all(), $reglas);

        if($validation->fails())
        {
            return Redirect::route('signup')
                ->with('flash_error', 'Error de validaci&oacute;n de datos.')
                ->withErrors($validation)->withInput();
        }

        // Validation ok, let's create the "User"
        $user = User::create(array(
            'nombre' => Input::get('nombre'),
            'apellido' => Input::get('apellido'),
            'alias' => Input::get('alias'),
            'email' => Input::get('email'),
            'direccion' => Input::get('direccion'),
            'edad' => Input::get('edad'),
            'password' => Hash::make( Input::get('password') ),
            'activo' => '1',
        ));

        // Establish the User Role
        $role = Role::where('name', '=', 'user')->get()->first();
        $user->attachRole( $role );

        if($user->save())
        {
            return Redirect::route('signupSuccess')->with('flash_success', 'Te has registrado exitosamente!');
        }

        // If errors, return this
        return Redirect::route('signup')->with('flash_error', 'No se pudo crear tu registro. Por favor inténtalo más tarde.');
    }

    public function signupSuccess()
    {
        return View::make('signup_success', array('page_title' => 'Registro Exitoso'));
    }

	public function login()
	{
		$email = Input::get('email');
		$password = Input::get('password');

        if(!isset($email) || !isset($password))
            return Redirect::to('/login')
                ->with('flash_error', 'Datos de acceso incorrectos.')
                ->withInput();

		if (Auth::attempt(['email' => $email, 'password' => $password]))
        {
            Session::put('welcome_msg_seen', false);
            Session::put('admin_comments_edit_hint_seen', false);
            return Redirect::to('home');
        }

        return Redirect::to('/login')
            ->with('flash_error', 'Datos de acceso incorrectos.')
            ->withInput();
	}

	public function logout()
	{
        Session::flush();
		Auth::logout();

        return Redirect::to('/home')->with('session_closed_msg', 'Has cerrado sesión correctamente.');
	}

}
