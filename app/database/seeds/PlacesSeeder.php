<?php
	class PlacesSeeder extends Seeder {
 
    public function run()
    {
        DB::table('places')->delete();
        DB::table('place_comments')->delete();
        DB::table('place_scores')->delete();

        // Let's create one Shop and one Parking
        Place::create(array(
            'id' => 1,
            'user_id' => 2,
            'type' => 'shop',
            'nombre' => 'Tienda Inacap',
            'direccion' => 'Vicuña Mackenna 3742-4098, Macul, Región Metropolitana de Santiago, Chile',
            'lat' => '-33.49065886097817',
            'lon' => '-70.6168981528931'
        ));

        Place::create(array(
            'id' => 2,
            'user_id' => 2,
            'type' => 'parking',
            'nombre' => "Parking Bikes",
            'direccion' => "Vicuña Mackenna 2301-2331, San Joaquín, Región Metropolitana de Santiago, Chile",
            'lat' => '-33.471705748038104',
            'lon' => '-70.62432289123541'
        ));

        ////////////////////////////////////////////
        Place::create(array(
            'id' => 3,
            'user_id' => 2,
            'type' => 'shop',
            'nombre' => "Tienda Quilín en Macul",
            'direccion' => "Quilín, Macul, Región Metropolitana de Santiago, Chile",
            'lat' => '-33.485218555633224',
            'lon' => '-70.61239204174808'
        ));
        Place::create(array(
            'id' => 4,
            'user_id' => 2,
            'type' => 'shop',
            'nombre' => "Taller Bicicletas Las Industrias",
            'direccion' => "Comercio 300, San Joaquín, Región Metropolitana, Chile",
            'lat' => '-33.493808355235096',
            'lon' => '-70.62882861859134'
        ));
        Place::create(array(
            'id' => 5,
            'user_id' => 2,
            'type' => 'shop',
            'nombre' => "Taller de Reparación Salvador",
            'direccion' => "Presidente Salvador Allende 17-47, San Joaquín, Región Metropolitana de Santiago, Chile",
            'lat' => '-33.49613461266201',
            'lon' => '-70.61694106823734'
        ));
        Place::create(array(
            'id' => 6,
            'user_id' => 2,
            'type' => 'shop',
            'nombre' => "Taller de Reparación Juan Sebastian",
            'direccion' => "Juan Sebastián Bach 235, San Joaquín, Región Metropolitana, Chile",
            'lat' => '-33.47967052392121',
            'lon' => '-70.62595329052738'
        ));
        Place::create(array(
            'id' => 7,
            'user_id' => 2,
            'type' => 'parking',
            'nombre' => "Metro Camino Agrícola",
            'direccion' => "Vicuña Mackenna 4100-4108, Macul, Región Metropolitana de Santiago, Chile",
            'lat' => '-33.49162519526151',
            'lon' => '-70.61741313702396'
        ));
        Place::create(array(
            'id' => 8,
            'user_id' => 2,
            'type' => 'parking',
            'nombre' => "Metro San Joaquín",
            'direccion' => "Vicuña Mackenna 4696-4800, Macul, Región Metropolitana de Santiago, Chile",
            'lat' => '-33.49835344611916',
            'lon' => '-70.61595401531986'
        ));
        Place::create(array(
            'id' => 9,
            'user_id' => 2,
            'type' => 'parking',
            'nombre' => "Metro Pedrero",
            'direccion' => "Nicomedes Guzmán 1963, Macul, Región Metropolitana, Chile",
            'lat' => '-33.50780074548853',
            'lon' => '-70.6123062110596'
        ));
        Place::create(array(
            'id' => 10,
            'user_id' => 2,
            'type' => 'parking',
            'nombre' => "Metro Rodrigo de Araya",
            'direccion' => "Vicuña Mackenna 2522-2998, Macul, Región Metropolitana de Santiago, Chile",
            'lat' => '-33.47752275862917',
            'lon' => '-70.6221771240235'
        ));
        Place::create(array(
            'id' => 11,
            'user_id' => 2,
            'type' => 'parking',
            'nombre' => "Metro Ñuble",
            'direccion' => "Carlos Dittborn 817, Ñuñoa, Región Metropolitana, Chile",
            'lat' => '-33.46721300347918',
            'lon' => '-70.62509498364261'
        ));
        Place::create(array(
            'id' => 12,
            'user_id' => 2,
            'type' => 'parking',
            'nombre' => "Metro Irarrázabal",
            'direccion' => "General Bustamante 1001, Ñuñoa, Región Metropolitana, Chile",
            'lat' => '-33.45375109636593',
            'lon' => '-70.62870025634771'
        ));
        ////////////////////////////////////////////

        // Let's add some comments and scores
        PlaceComment::create(array(
            'id' => 1,
            'user_id' => 2,
            'place_id' => 2,
            'comentario' => 'Excelente lugar, la atención es muy buena. Definitivamente la recomiendo!!'
        ));

        PlaceComment::create(array(
            'id' => 2,
            'user_id' => 2,
            'place_id' => 2,
            'comentario' => 'Olvidé comentar que el lugar es muy limpio y acogedor.'
        ));

        PlaceComment::create(array(
            'id' => 3,
            'user_id' => 3,
            'place_id' => 2,
            'comentario' => 'Fantastic place, i really appreciate the form how they attend me, I insist, very cute place!!'
        ));

        PlaceComment::create(array(
            'id' => 4,
            'user_id' => 3,
            'place_id' => 1,
            'comentario' => 'Tienda con un servicio muy profesional, realmente la recomiendo a todos quienes deseen mejorar el acondicionamiento técnico de su bicicleta.'
        ));

        PlaceComment::create(array(
            'id' => 5,
            'user_id' => 2,
            'place_id' => 1,
            'comentario' => 'Linda tienda, lo mejor es que te sirven un café mientras reparan tu bici y además hay wifi !!'
        ));

        PlaceComment::create(array(
            'id' => 6,
            'user_id' => 3,
            'place_id' => 1,
            'comentario' => 'Excelente tienda de reparación, un lugar donde puedes encontrar de todo. Muy buena atención del dueño. Recomendada totalmente!!'
        ));

        // Let's add some scores!
        PlaceScore::create(array(
            'id' => 1,
            'user_id' => 2,
            'place_id' => 2,
            'score' => 7
        ));

        PlaceScore::create(array(
            'id' => 2,
            'user_id' => 3,
            'place_id' => 2,
            'score' => 5
        ));

        PlaceScore::create(array(
            'id' => 3,
            'user_id' => 4,
            'place_id' => 2,
            'score' => 6
        ));
    }
}