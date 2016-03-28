<?php

class VideoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$comments=Video::where('publicado', '=', '1')->get();
            $comments = Video::where('publicado', '=', '1')
                                      ->with('usuarios')->paginate(3);


    
	   return View::make('video.index', array(
            'page_title' => 'Video Ayuda',
            'heading_title' => 'Videos',
            'selected_menu' => 'comments',
            'header_title' => true,
             'comments' => $comments
           
        ));
	
    
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	
		return View::make('video.create', array(
            'page_title' => 'Publicar Video',
            'heading_title' => 'Publicar Video',
            'header_title' => true
           
        ));
	
	}




	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{


	  $reglas = array(
			'titulo' => 'required|alpha_spaces',
			'comentario' => 'required|alpha_spaces',
			'archivo' => 'required|max:60000|mimes:mp4'
			
			);


	    $datos = array(
        	'titulo'=>Input::get('titulo'),
            'comentario'=>Input::get('comentario'),
            'archivo'=>Input::file('archivo'),       
             );
      
        $validation = Validator::make($datos, $reglas);

        if($validation->fails())
        {
            return Redirect::route('video.create')
                ->with(array(
                    'flash_msg' => 'Error de validación, por favor ingresa los campos del formulario correctamente.',
                    'flash_type' => 'danger'
                ))
                ->withErrors($validation)->withInput();
        }
      

        $path='uploads';
        $upload= $datos['archivo']->move($path);
        $video = new Video;
	    $video->titulo = $datos['titulo'];
	    $video->descripcion = $datos['comentario'];
        $video->url =$upload;
        $video->publicado =0;     
        $video->save();

       $creador = Input::get('creador');
        Video::find($video->id)->usuarios()->attach($creador, array('fecha' => date("Y-m-d")));
     
        if($video->save())
        {
            return Redirect::route('video.create')
                ->with(array(
                    'flash_msg' => 'Gracias! Tu video será visible una vez que el administrador lo haya aprobado',
                    'flash_type' => 'success'
                ));

        }

        // If errors, return this
        return Redirect::route('video.create')->with('flash_error', 'No se pudo ingresar tu video. Por favor inténtalo más tarde.');
    }
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{  
   
 
		 $videos = User::where('id',$id)->with('videos')->get();
		
	     return View::make('video.misvideos', array(
            'page_title' => 'Mis Videos',
            'heading_title' => 'Mis Videos',
            'header_title' => true,
            'comments' => $videos


           
        ));
		
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{  
      
           $video = Video::find($id);
         
           return View::make('video.edit', array(
            'page_title' => 'Editar Video',
            'heading_title' => 'Editar Video',
            'header_title' => true,
            'comment' => $video


           
        ));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		

		   $reglas = array(
			'titulo' => 'required|alpha_spaces',
			'descripcion' => 'required|alpha_spaces',
				
			);


	    $datos = array(

		        	'titulo'=>Input::get('titulo'),
		            'descripcion'=>Input::get('descripcion'),
                 
                  );
      
        $validation = Validator::make($datos, $reglas);

        if($validation->fails())
        {
            return Redirect::route('video.edit',$id)
                ->with(array(
                    'flash_msg' => 'Error de validación, por favor ingresa los campos del formulario correctamente.',
                    'flash_type' => 'danger'
                ))
                ->withErrors($validation)->withInput();
        }
      
        $video = Video::find($id);
	    $video->titulo = $datos['titulo'];
	    $video->descripcion = $datos['descripcion'];  
        $video->save();

     
        if($video->save())
        {
            return Redirect::route('video.edit',$id)
                ->with(array(
                    'flash_msg' => 'Gracias! Tu video fue editado con éxito',
                    'flash_type' => 'success'
                ));

        }

        // If errors, return this
        return Redirect::route('video.edit',$id)->with('flash_error', 'No se pudo editar tu video. Por favor inténtalo más tarde.');
        
        


	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{  

   

            
	    
	}
}
