<?php

class UserProfileController extends BaseController {

	/**
	 * Show the form for editing the user profile.
	 *
	 * @return Response
	 */
	public function editProfile()
	{
        $user = Auth::user();
        return View::make('users.edit_profile', array(
            'user' => $user,
            'page_title' => 'Editar mis Datos',
            'header_title' => 'Editar mis Datos',
            'selected_menu' => 'user_profile'
        ));
	}


    //Funcion para ver perfil de lugares--- PENDIENTE POR FUNCIONAMIENTO
    public function editProfilePlace()
    {
        $user = Auth::user();
        return View::make('users.edit_profile_place', array(
            'user' => $user,
            'page_title' => 'Perfil de Lugares',
            'header_title' => 'Perfil de Lugares',
            'selected_menu' => 'user_profile'
        ));
    }

    public function adminPlaces()
    {
        $places = DB::table('places')->orderBy('publicado')->get();

        return View::make('users.list_places', array(
            'page_title' => 'Perfil Marcadores',
            'heading_title' => 'Perfil Marcadores',
            'selected_menu' => 'user_profile',
            'header_title' => true,
            'places' => $places
        ));
    }






    /**
     * Show the form for editing the user password.
     *
     * @return Response
     */
    public function editPassword()
    {
        $user = Auth::user();
        return View::make('users.edit_password', array(
            'user' => $user,
            'page_title' => 'Cambiar Contraseña',
            'header_title' => 'Cambiar Contraseña',
            'selected_menu' => 'user_profile'
        ));
    }

	/**
	 * Update the user profile
	 *
	 * @return Response
	 */
	public function updateProfile()
	{
        $reglas = array(
            'nombre' => array('required', 'max:100'),
            'apellido' => array('required', 'max:100'),
            'alias' => array('max:100'),
            'direccion' => array('max:100'),
            'edad' => array('max:100')
        );

        $validation = Validator::make( Input::all(), $reglas);

        if($validation->fails())
        {
            return Redirect::route('editProfile')
                ->with(array(
                    'flash_msg' => 'Errores de validación, por favor revisa los campos indicados.',
                    'flash_type' => 'danger'
                ))
                ->withErrors($validation)->withInput();
        }

        // Validation ok, let's update the "User"

        $affectedRows = User::where('id', '=', Auth::user()->id)->update(array(
            'nombre' => Input::get('nombre'),
            'apellido' => Input::get('apellido'),
            'alias' => Input::get('alias'),
            'direccion' => Input::get('direccion'),
            'edad' => Input::get('edad')
        ));

        if($affectedRows){

            // Return success message
            return Redirect::route('editProfile')
                ->with(array(
                    'flash_msg' => '¡Datos actualizados con éxito!',
                    'flash_type' => 'success'
                ));
        }
        else
        {
            return Redirect::route('editProfile')
                ->with(array(
                    'flash_msg' => 'Error de almacenamiento. Por favor intenténtalo más tarde.',
                    'flash_type' => 'danger'
                ))
                ->withErrors($validation)->withInput();
        }
	}

    /**
     * Update the user password
     *
     * @return Response
     */
    public function updatePassword()
    {
        $reglas = array(
            'current_password' => array('required', 'max:100'),
            'password' => array('required', 'min:3', 'max:20', 'confirmed'),
            'password_confirmation' => array('required', 'max:100')
        );

        /// -----------------------------------------------> QUEDE PENDIENTE EN VALIDACIÓN DE ACTUAL PASSWORD (tema hash )
        //dd( Auth::user()->password );

        $validation = Validator::make( Input::all(), $reglas);

        if($validation->fails())
        {
            return Redirect::route('editPassword')
                ->with(array(
                    'flash_msg' => 'Errores de validación, por favor revisa los campos indicados.',
                    'flash_type' => 'danger'
                ))
                ->withErrors($validation)->withInput();
        }

        // Validate current password
        if(!Hash::check(Input::get('current_password'), Auth::user()->password))
        {
            return Redirect::route('editPassword')
                ->with(array(
                    'flash_msg' => 'Contraseña actual inválida.',
                    'flash_type' => 'danger'
                ));
        }


        // Validation ok, let's update the "User"
        $affectedRows = User::where('id', '=', Auth::user()->id)->update(array(
            'password' => Hash::make( Input::get('password') )
        ));

        if($affectedRows){

            // Return success message
            return Redirect::route('editPassword')
                ->with(array(
                    'flash_msg' => '¡Contraseña actualizada con éxito!',
                    'flash_type' => 'success'
                ));
        }
        else
        {
            return Redirect::route('editPassword')
                ->with(array(
                    'flash_msg' => 'Error de almacenamiento. Por favor intente más tarde.',
                    'flash_type' => 'danger'
                ))
                ->withErrors($validation)->withInput();
        }
    }

    /**
     * Show the form for create a shop
     *
     * @return Response
     */
    public function createShopFrm()
    {
        return View::make('users.create_place_frm', array(
            'page_title' => 'Ingresar Tienda',
            'header_title' => 'Ingresar Tienda',
            'selected_menu' => 'user_profile',
            'type' => 'shop',
            'type_translation' => 'tienda'
        ));
    }

    /**
     * Show the form for create a parking
     *
     * @return Response
     */
    public function createParkingFrm()
    {
        return View::make('users.create_place_frm', array(
            'page_title' => 'Ingresar Estacionamiento',
            'header_title' => 'Ingresar Estacionamiento',
            'selected_menu' => 'user_profile',
            'type' => 'parking',
            'type_translation' => 'estacionamiento'
        ));
    }

    /**
     * Creates a place (e.g. Shop, Parking..)
     *
     * @return Response
     */

    //Se crea la funcion crear taller

    public function createWorkshopFrm()
    {
        return View::make('users.create_place_frm', array(
            'page_title'=>'Ingresar Taller',
            'header_title'=>'Ingresar Taller ',
            'selected_menu'=>'user_profile',
            'type'=>'workshop', //Aca va tipo workshop, es decir el tipo de marcador en el mapa
            'type_translation'=>'taller'
            ));
    }


    public function places()
    {
        $places = Place::where('publicado','1')->get();

        return View::make('places.show_places', array(
            'page_title' => 'Comentariosxd',
            'heading_title' => 'Comentariosxd',
            'selected_menu' => 'places',
            'header_title' => true,
            'places' => $places
        ));
    }


    public function createPlace()
    {

        $reglas = array(
            'type' => array('required', 'max:100'),
            'nombre' => array('required', 'max:100'),
            'direccion' => array('required', 'max:100'),
            'lon' => array('required', 'max:50'),
            'lat' => array('required', 'max:50')
        );

        $type = Input::get('type');

        switch($type){
            case 'shop':
                $route = 'createShopFrm';
                $place_translation = 'Tienda';
                $letter = 'a';
                break;

            case 'parking':
                $route = 'createParkingFrm';
                $place_translation = 'Estacionamiento';
                $letter = 'o';
                break;

            case 'workshop':
                $route='createWorkshopFrm';
                $place_translation='Taller';
                $letter = 'o';
                break;

        }

        $validation = Validator::make( Input::all(), $reglas);

        if($validation->fails())
        {
            if( (($type !== 'shop') && ($type !== 'parking') && ($type!=='workshop')) || ($type == "") )
                return Redirect::route('home');

            return Redirect::route($route)
                ->with(array(
                    'flash_msg' => 'Error de validación.',
                    'flash_type' => 'danger'
                ))
                ->withErrors($validation)->withInput();
        }

        /*if( ($type !== 'shop') || ($type !== 'parking') )
            return Redirect::route('home');*/

        // Validation ok, let's create the "Place"


        $place = Place::create(array(
            'user_id' => Auth::user()->id,
            'type' => Input::get('type'),
            'nombre' => Input::get('nombre'),
            'direccion' => Input::get('direccion'),
            'lat' => Input::get('lat'),
            'lon' => Input::get('lon')
        ));

        if($place->save())
        {
            return Redirect::route($route)
                ->with(array(
                    'flash_msg' => $place_translation.' ingresad'.$letter.' correctamente. Una vez que el administrador apruebe tu publicación, el marcador aparecerá en el mapa. Gracias por colaborar!.',
                    'flash_type' => 'success'
                ));

        }

        // If errors, return this
        return Redirect::route($route)
            ->with(array(
                'flash_msg' => 'En estos momentos existe un problema con la base de datos. Por favor inténtalo más tarde.',
                'flash_type' => 'danger'
            ));


    }


    public function evaluatePlace($place_id)
    {
        // Let's continue only if the place_id really exist!
        if(!isset($place_id))
            return Redirect::route('home');

        $place = Place::where('id', $place_id)->get()->first();
        $place_comments = PlaceComment::where('place_id', $place_id)->orderBy('created_at','DESC')->get();

        // Let's continue only if the place really exist!
        if(!$place)
            return Redirect::route('home');

        $score_counter = PlaceScore::where('place_id', $place_id)->count();

        $has_evaluated = PlaceScore::where('user_id', Auth::user()->id)->where('place_id', $place_id)->count();

        if($score_counter)
            $score_sum = PlaceScore::where('place_id', $place_id)->sum('score');


        switch($score_counter)
        {
            case 0:
                $score_average = 0;
                break;

            default:
                $score_average = $score_sum / $score_counter;
        }

        $type_phrase = $place->type == "shop" ? "Tienda" : "Estacionamiento"; 
        //Esta linea que pretende hacer?, mas que nada, el simbolo "?" que intenta decir o expresar. 
        //Junto con tienda : Estacionamiento
        //Si quisiera agregar otra variable como "Workshop", como seguiría esa linea?


        return View::make('users.evaluate_place', array(
            'page_title' => 'Evaluar '.$type_phrase,
            'header_title' => 'Evaluar '.$type_phrase,
            'selected_menu' => 'user_profile',
            'place' => $place,
            'place_comments' => $place_comments,
            'place_scores' => $place->scores,
            'score_counter' => $score_counter,
            'score_average' => round($score_average, 1),
            'has_evaluated' => $has_evaluated
        ));
    }

    /**
     * Creates a place comment
     *
     * @return Response
     */
    public function createPlaceComment()
    {
        $reglas = array(
            'place_id' => array('required', 'numeric', 'min:1'),
            'comentario' => array('required', 'max:512')
        );

        $validation = Validator::make( Input::all(), $reglas);

        $place_id = Input::get('place_id');

        // Let's continue only if the place_id param exist!
        if(!$place_id)
            return Redirect::route('home');

        if($validation->fails())
        {

            return Redirect::route('evaluatePlace', $place_id)
                ->with(array(
                    'flash_msg' => 'Error de validación, por favor ingresa los campos del formulario correctamente.',
                    'flash_type' => 'danger'
                ))
                ->withErrors($validation)->withInput();
        }

        // Validation ok, let's create the "PlaceComment"
        $place_comment = PlaceComment::create(array(
            'user_id' => Auth::user()->id,
            'place_id' => $place_id,
            'comentario' => Input::get('comentario')
        ));

        if($place_comment->save())
        {
            return Redirect::route('evaluatePlace', $place_id)
                ->with(array(
                    'flash_msg' => 'Gracias! Tu comentario fue publicado con éxito!',
                    'flash_type' => 'success'
                ));
        }

        // If errors, return this
        return Redirect::route('evaluatePlace', $place_id)->with('flash_error', 'No se pudo ingresar tu comentario. Por favor inténtalo más tarde.');
    }

    /**
     * Creates a place score
     *
     * @return Response
     */
    public function scorePlace()
    {
        $reglas = array(
            'place_id' => array('required', 'numeric', 'min:1'),
            'score' => array('required', 'numeric', 'min:1', 'max:7')
        );

        $validation = Validator::make( Input::all(), $reglas);

        if($validation->fails())
            return Response::json( array('return' => 'validation_error') );

        // Validation ok, let's create the "PlaceScore" register
        $place_score = PlaceScore::create(array(
            'user_id' => Auth::user()->id,
            'place_id' => Input::get('place_id'),
            'score' => Input::get('score')
        ));

        // Let's store and return success
        if($place_score->save())
            return Response::json( array('return' => 'success') );

        // If errors, return this
        return Response::json( array('return' => 'storage_error') );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deletePlaceScore()
    {
        if(!Input::get('place_id'))
            return Response::json( array('return' => 'validation_error') );

        try
        {
            $affectedRows = PlaceScore::where('user_id', '=', Auth::user()->id)
                ->where('place_id', Input::get('place_id'))
                ->delete();
        }
        catch (Exception $e)
        {
            return Response::json( array('return' => 'exception_error') );
        }

        if($affectedRows){
            return Response::json( array('return' => 'success') );
        }
        else{
            return Response::json( array('return' => 'deleted_cero') );
        }

        // If errors, return this
        return Response::json( array('return' => 'storage_error') );
    }
}
