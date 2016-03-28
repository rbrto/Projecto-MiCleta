<?php

class PlacesController extends BaseController {

    /**
     * Show comments
     *
     * @return Response
     */
    public function places()
    {
        $places = Place::where('publicado','1')->orderBy('created_at','DESC')->get();

        return View::make('places.show_places', array(
            'page_title' => 'Lugares',
            'heading_title' => 'Lugares',
            'selected_menu' => 'lugares',
            'header_title' => true,
            'places' => $places
        ));
    }
}