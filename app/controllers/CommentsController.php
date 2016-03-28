<?php

class CommentsController extends BaseController {

    /**
     * Show comments
     *
     * @return Response
     */
    public function comments()
    {
        $comments = Comment::where('publicado','1')->orderBy('created_at','DESC')->get();

        return View::make('comments.show_comments', array(
            'page_title' => 'Comentarios',
            'heading_title' => 'Comentarios',
            'selected_menu' => 'comments',
            'header_title' => true,
            'comments' => $comments
        ));
    }



    

    /**
     * Creates a comment
     *
     * @return Response
     */
    public function createComment()
    {
        $reglas = array(
            'nombre' => array('required', 'max:100'),
            'email' => array('required', 'email'),
            'comentario' => array('required', 'max:512')
        );

        $validation = Validator::make( Input::all(), $reglas);

        if($validation->fails())
        {
            return Redirect::route('comments')
                ->with(array(
                    'flash_msg' => 'Error de validación, por favor ingresa los campos del formulario correctamente.',
                    'flash_type' => 'danger'
                ))
                ->withErrors($validation)->withInput();
        }

        // Validation ok, let's create the "User"
        $comment = Comment::create(array(
            'nombre' => Input::get('nombre'),
            'email' => Input::get('email'),
            'comentario' => Input::get('comentario')
        ));

        if($comment->save())
        {
            return Redirect::route('comments')
                ->with(array(
                    'flash_msg' => 'Gracias! Tu comentario será visible una vez que el administrador lo haya aprobado',
                    'flash_type' => 'success'
                ));

        }

        // If errors, return this
        return Redirect::route('comments')->with('flash_error', 'No se pudo ingresar tu comentario. Por favor inténtalo más tarde.');
    }

}
