<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Default route
Route::get('/', array(
    'as' => 'defaultRoute',
    'uses' => 'HomeController@defaultRoute'
));

// Home route
Route::get('/home', array(
    'as' => 'home',
    'uses' => 'HomeController@index'
));

// Shops route
Route::get('/tiendas', array(
    'as' => 'shops',
    'uses' => 'HomeController@shops'
));

//Workshop route
Route::get('/talleres', array(
    'as'=>'workshops',
    'uses'=> 'HomeController@workshops'
));

// Parking route
Route::get('/estacionamientos', array(
    'as' => 'parkings',
    'uses' => 'HomeController@parkings'
));

// Signup routes
Route::get('registro', array(
    'as' => 'signup',
    'uses' => 'AuthController@signup'
));

Route::post('register', 'AuthController@register');

Route::get('registro_exitoso', array(
    'as' => 'signupSuccess',
    'uses' => 'AuthController@signupSuccess'
));

// Login routes
Route::get('login', array(
    'as' => 'login',
    'uses' => 'AuthController@index'
));

Route::post('login', 'AuthController@login');

// Logout route
Route::get('logout', array(
    'as' => 'logout',
    'uses' => 'AuthController@logout'
));


// User Comments Routes
Route::get('comentarios', array(
    'as' => 'comments',
    'uses' => 'CommentsController@comments'
));

Route::post('create_comment', array(
    'as' => 'createComment',
    'uses' => 'CommentsController@createComment'
));


//PRUEBA PRUEBA ----
Route::get('lugares', array(
    'as' => 'places',
    'uses' => 'UserProfileController@places'
));

Route::post('create_place', array(
    'as' => 'createPlace',
    'uses' => 'UserProfileController@createPlace'
));




// Secure Users Profile Routes
Route::group(array('before' => 'user_authentication'), function(){

    Route::get('editar_datos', array(
        'as' => 'editProfile',
        'uses' => 'UserProfileController@editProfile'
    ));

    Route::post('updateProfile', array(
        'as' => 'updateProfile',
        'uses' => 'UserProfileController@updateProfile'
    ));

    Route::get('editar_password', array(
        'as' => 'editPassword',
        'uses' => 'UserProfileController@editPassword'
    ));

    Route::post('update_password', array(
        'as' => 'updatePassword',
        'uses' => 'UserProfileController@updatePassword'
    ));

    Route::get('crear_tienda', array(
        'as' => 'createShopFrm',
        'uses' => 'UserProfileController@createShopFrm'
    ));

    //Crear ruta para taller
    Route::get('crear_taller',array(
        'as' => 'createWorkshopFrm',
        'uses' =>'UserProfileController@createWorkshopFrm'
    ));

    Route::get('crear_estacionamiento', array(
        'as' => 'createParkingFrm',
        'uses' => 'UserProfileController@createParkingFrm'
    ));

    Route::post('crear_lugar', array(
        'as' => 'createPlace',
        'uses' => 'UserProfileController@createPlace'
    ));

    Route::post('create_place_comment', array(
        'as' => 'createPlaceComment',
        'uses' => 'UserProfileController@createPlaceComment'
    ));

    Route::post('puntuar_lugar', array(
        'as' => 'scorePlace',
        'uses' => 'UserProfileController@scorePlace'
    ));

    Route::post('eliminar_puntuacion_lugar', array(
        'as' => 'deletePlaceScore',
        'uses' => 'UserProfileController@deletePlaceScore'
    ));
});

Route::group(array('before' => 'user_authentication_login'), function(){
    Route::get('evaluar/{place_id}', array(
        'as' => 'evaluatePlace',
        'uses' => 'UserProfileController@evaluatePlace'
    ));
});

// Secure Admin Comments Routes
Route::group(array('before' => 'admin_authentication'), function(){

    //Rutas para comentarios

    Route::get('administrar_comentarios', array(
        'as' => 'adminComments',
        'uses' => 'AdminProfileController@adminComments'
    ));

    Route::get('editar_comentario/{comment_id}/edit', array(
        'as' => 'editComment',
        'uses' => 'AdminProfileController@editComment'
    ));

    Route::put('editar_comentario/{comment_id}', array(
        'as' => 'updateComment',
        'uses' => 'AdminProfileController@updateComment'
    ));

    Route::delete('eliminar_comentario/{comment_id}', array(
        'as' => 'deleteComment',
        'uses' => 'AdminProfileController@deleteComment'
    ));

    //Ruta para administrar lugares---PENDIENTE DE FUNCIONAMIENTO
    Route::get('administrar_lugares', array(
        'as' => 'adminPlaces',
        'uses' => 'AdminProfileController@adminPlaces'
    ));

    Route::get('editar_lugar/{place_id}/edit', array(
        'as' => 'editPlace',
        'uses' => 'AdminProfileController@editPlace'
    ));
    //CREAR RUTA EDITAR SERVICIO 
    Route::get('editar_servicio/{place_id}/edit', array(
        'as' => 'editService',
        'uses' => 'AdminProfileController@editService'
    ));

    Route::put('editar_lugar/{place_id}', array(
        'as' => 'updatePlace',
        'uses' => 'AdminProfileController@updatePlace'
    ));

    Route::put('editar_servicio/{place_id}', array(
        'as' => 'updateService',
        'uses' => 'AdminProfileController@updateService'
    ));

    Route::delete('eliminar_lugar/{place_id}', array(
        'as' => 'deletePlace',
        'uses' => 'AdminProfileController@deletePlace'
    ));

    Route::get('administrar_videos', array(
        'as' => 'adminVideos',
        'uses' => 'AdminProfileController@adminVideos'
    ));


  Route::post('editar_video', array(
     'as' => 'editVideo',
        'uses' => 'AdminProfileController@editVideoPublicacion'
    ));

     Route::get('editar_video/{video_id}/edit', array(
     'as' => 'editVideoGet',
        'uses' => 'AdminProfileController@editVideoGet'
    ));    

       Route::get('detalle_video/{video_id}', array(
        'as' => 'detalleVideo',
        'uses' => 'AdminProfileController@detalleVideo'
    ));
 

      Route::get('show_videos', array(
        'as' => 'showVideos',
        'uses' => 'AdminProfileController@showVideos'
    ));




    //Rutas para lugares 

    // Route::get('administrar_lugares', array(
    //     'as' =>'adminPlaces',
    //     'uses' => 'AdminProfileController@adminPlaces' // :S
    // ));

    // Route::get('editar_lugar/{place_id}/edit', array(
    //     'as' => 'editPlace',
    //     'uses' => 'UserProfileController@editPlace' //OK
    // ));

    // Route::put('editar_lugar/{place_id}', array(
    //     'as' => 'updatePlace',
    //     'uses' => 'UserProfileController@updatePlace' //OK
    // ));

    // Route::delete('eliminar_lugar/{lugar_id}', array(
    //     'as' => 'deletePlace',
    //     'uses' => 'UserProfileController@deletePlace' //OK
    // ));
});

Route::resource('video', 'VideoController');