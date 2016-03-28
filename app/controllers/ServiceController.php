<?php

class VideoController extends \BaseController {

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






}