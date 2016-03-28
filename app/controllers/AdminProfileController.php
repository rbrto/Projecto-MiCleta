<?php

class AdminProfileController extends BaseController {

    /**
     * Display a listing of comments for approval.
     *
     * @return Response
     */
    public function adminComments()
    {
        $comments = DB::table('comments')->orderBy('publicado')->get();

        return View::make('admin.list_comments', array(
            'page_title' => 'Comentarios',
            'heading_title' => 'Comentarios',
            'selected_menu' => 'admin_profile',
            'header_title' => true,
            'comments' => $comments
        ));
    }

    //PENDIENTE DE FUNCIONAMIENTO 
    public function adminPlaces()
    {
        $places= DB::table('places')->orderBy('publicado')->get();

        return View::make('admin.list_places', array(
            'page_title' => 'Marcadores',
            'heading_title' => 'Marcadores',
            'selected_menu' => 'admin_profile',
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
                    'flash_msg' => 'Error de almacenamiento. Por favor inténtalo más tarde.',
                    'flash_type' => 'danger'
                ))
                ->withErrors($validation)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deleteComment($id)
    {
        $msg = null;

        if(isset($id) && $id > 0){

            try
            {
                $affectedRows = Comment::where('id', '=', $id)->delete();
            }
            catch (Exception $e)
            {
                return Response::json( "EXCEPTION_ERROR" );
            }

            if($affectedRows){
                $msg = "DELETED_SUCCESS";
            }
            else{
                $msg = "DELETED_CERO";
            }

            return Response::json( $msg );
        }
        else
            return Response::json( "DELETION_ERROR" );
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    //PENDIENTE DE FUNCIONAMIENTO
    public function deletePlace($id)
    {
        $msg = null;

        if(isset($id) && $id > 0){

            try
            {
                $affectedRows = Place::where('id', '=', $id)->delete();
            }
            catch (Exception $e)
            {
                return Response::json( "EXCEPTION_ERROR" );
            }

            if($affectedRows){
                $msg = "DELETED_SUCCESS";
            }
            else{
                $msg = "DELETED_CERO";
            }

            return Response::json( $msg );
        }
        else
            return Response::json( "DELETION_ERROR" );
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function editComment($id)
    {
        $comment = Comment::find($id);

        return View::make('admin.edit_comment', array(
            'page_title' => 'Editar Comentario',
            'header_title' => 'Editar Comentario',
            'selected_menu' => 'admin_profile',
            'comment' => $comment
        ));
    }


    //PENDIENTE DE FUNCIONAMIENTO
    public function editPlace($id)
    {
        $place = Place::find($id);

        return View::make('admin.edit_place', array(
            'page_title' => 'Editar Lugar',
            'header_title' => 'Editar Lugar',
            'selected_menu' => 'admin_profile',
            'place' => $place
        ));
    }


    public function editService($id)
    {
        $place = Place::find($id);

        return View::make('admin.edit_service', array(
            'page_title' => 'Editar Servicios',
            'header_title' => 'Editar Servicios',
            'selected_menu' => 'admin_profile',
            'place' => $place
        ));
    }


    /**
     * Update a user comment status
     *
     * @return Response
     */
    public function updateComment($comment_id)
    {

        // Validate basic data
        if( (!isset($comment_id)) )
            return Redirect::route('home');

        $reglas = array(
            'publicado' => array('required', 'numeric', 'min:0', 'max:1')
        );

        $validation = Validator::make( Input::all(), $reglas);

        if($validation->fails())
        {
            return Redirect::route('editComment', $comment_id)
                ->with(array(
                    'flash_msg' => 'Error de validación. Debes especificar el estado de publicación que deseas actualizar.',
                    'flash_type' => 'danger'
                ))
                ->withErrors($validation)->withInput();
        }

        // Validation ok, let's update the "Comment"

        $affectedRows = Comment::where('id', '=', $comment_id)->update(array(
            'publicado' => Input::get('publicado')
        ));

        if($affectedRows){

            // Return success message
            return Redirect::route('editComment', $comment_id)
                ->with(array(
                    'flash_msg' => '¡Datos actualizados con éxito!',
                    'flash_type' => 'success'
                ));
        }
        else
        {
            return Redirect::route('editComment', $comment_id)
                ->with(array(
                    'flash_msg' => 'Error al intentar actualizar. Por favor intenténtalo más tarde.',
                    'flash_type' => 'danger'
                ))
                ->withErrors($validation)->withInput();
        }
    }

    public function updatePlace($place_id)
    {

        // Validate basic data
        if( (!isset($place_id)) )
            return Redirect::route('home');


        //Se aplican reglas de validacion antes de generar las acciones
        $reglas = array(
            'publicado' => array('required', 'numeric', 'min:0', 'max:1')
        );

        $validation = Validator::make( Input::all(), $reglas);

        if($validation->fails())
        {
            //Editar mensaje de error
            return Redirect::route('editPlace', $place_id)
                ->with(array(
                    'flash_msg' => 'Error de validación. Debes especificar el estado de publicación que deseas actualizar.',
                    'flash_type' => 'danger'
                ))
                ->withErrors($validation)->withInput();
        }

        // Validation ok, let's update the "place"


        //Se Agregan los campos de correo y contraseña para generar perfil de tienda y taller
        $affectedRows = Place::where('id', '=', $place_id)->update(array(
            // 'email' => input::get('email'),
            // 'password' => Hash::make( Input::get('password') ),
            'publicado' => Input::get('publicado')
        ));


        if($affectedRows){

            // Return success message
            return Redirect::route('editPlace', $place_id)
                ->with(array(
                    'flash_msg' => '¡Datos actualizados correctamente!',
                    'flash_type' => 'success'
                ));
        }
        else
        {
            return Redirect::route('editPlace', $place_id)
                ->with(array(
                    'flash_msg' => 'Error al intentar actualizar. Por favor intenténtalo más tarde.',
                    'flash_type' => 'danger'
                ))
                ->withErrors($validation)->withInput();
        }
    }


    public function updateService($place_id)
    {

        // Vealidate basic data
        if( (!isset($place_id)) )
            return Redirect::route('home');


        //Se aplican reglas de validacion antes de generar las acciones
        $reglas = array(
            'servicios' => 'required'
        );

        $validation = Validator::make(Input::all(), $reglas);

        if($validation->fails())
        {
            //Editar mensaje de error
            return Redirect::route('editService', $place_id)
                ->with(array(
                    'flash_msg' => 'Error de validación. Debe seleccionar al menos un servicio.',
                    'flash_type' => 'danger'
                ))
                ->withErrors($validation)->withInput();
        }

     
         
          $place= Place::find($place_id);
         

        if($place){
           
           //Ojo que para ingresar datos en una tabla pivote esta el metodo attach y sync 
           //no es lo mismo por ejemplo si ingreso una relacion que ya existe en la base de datos se duplica 
           // en cambio con el metodo sync no pasa eso, ahi ustedes ven cual usar por defecto les dejo (sync)
              $place->services()->sync(Input::get('servicios'));

            // Return success message
            return Redirect::route('editService', $place_id)
                ->with(array(
                    'flash_msg' => '¡Datos actualizados correctamente!',
                    'flash_type' => 'success'
                ));
        }
        else
        {
            return Redirect::route('editService', $place_id)
                ->with(array(
                    'flash_msg' => 'Error al intentar actualizar. Por favor intenténtalo más tarde.',
                    'flash_type' => 'danger'
                ))
                ->withErrors($validation)->withInput();
        }
        
    }


//TESTER PARA INGRESAR SERVICIOS

    public function insertService()
    {
        $reglas = array(
            'id_places' => array('required', 'numeric', 'min:1'),
            'id_service' => array('required', 'numeric', 'min:1')
        );

        $validation = Validator::make( Input::all(), $reglas);

        if($validation->fails())
            return Response::json( array('return' => 'validation_error') );

        // Validation ok, let's create the "insert Service" register
        $service_places = PlaceScore::create(array(
        $service_places =     
            'id_places' => Input::get('id_places'),
            'id_service' => Input::get('id_service')
            
        ));

        // Let's store and return success
        if($place_score->save())
            return Response::json( array('return' => 'success') );

        // If errors, return this
        return Response::json( array('return' => 'storage_error') );
    }





    public function adminVideos()
    {
         
          //$comments= Video::all();
    $videos = Video::orderBy('publicado')->with('usuarios')->get();
        
       

        return View::make('admin.list_videos', array(
            'page_title' => 'Videos',
            'heading_title' => 'Videos',
            'header_title' => true,
             'comments' => $videos
           
        ));
    }



    public function showVideos()
    {
       
         $comments = Video::with('usuarios')->paginate(2);


        return View::make('admin.show_videos', array(
            'page_title' => 'Videos',
            'heading_title' => 'Videos',
            'header_title' => true,
             'comments' => $comments
           
        ));
    }



    public function editVideoPublicacion()
    {
      
        if(Request::ajax())
        {
            $video = Video::find(Input::get('id'));
                        
           if($video->publicado == 0)
           {
              $video->publicado=1;
              $video->save();
              $mensaje="PUBLICADO";

                $data = array
                (
                  'titulo'      =>  Input::get('titulo'),
                  'nombre'   => Input::get('nombre'),
                  'apellido'   => Input::get('apellido'),
                  'email'      =>  Input::get('email')
                );

               $toEmail = $data['email'];
          
          
            Mail::send('emails.contacto', $data, function ($message) use ($toEmail)
            {
                $message->subject('Publicacion Video');
                $message->to('montecinosda@gmail.com');
                 //$message->to($toEmail);
            });

            
              return Response::json($mensaje);
                 
           }
           else
           {
            $video->publicado=0;
            $video->save();
             $mensaje="NOPUBLICADO";
            return Response::json($mensaje);
              
           } 
        }
    }


   public function editVideoGet($id)
    {
        $comment = Comment::find($id);

        return View::make('admin.edit_comment', array(
            'page_title' => 'Editar Comentario',
            'header_title' => 'Editar Comentario',
            'comment' => $comment
        ));
    }



      public function detalleVideo($id)
    {
        
       $comment = Video::find($id);

        return View::make('admin.detalle_video', array(
            'page_title' => 'Detalle Video',
            'header_title' => 'Detalle Video',
            'comment' => $comment
        ));
    }
}






    



    















