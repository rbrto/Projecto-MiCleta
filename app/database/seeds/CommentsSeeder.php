<?php
	class CommentsSeeder extends Seeder {
 
    public function run()
    {
        DB::table('comments')->delete();

        Comment::create(array(
            'id' => 1,
            'nombre' => 'Richard',
            'email' => 'richardyoung@live.cl',
            'comentario' => 'Excelente sitio web, interfaz muy amigable. Un real aporte a la sociedad.',
            'publicado' => '1'
        ));

        Comment::create(array(
            'id' => 2,
            'nombre' => 'Joey Aragonés',
            'email' => 'joey.aragones@gmail.com',
            'comentario' => 'Felicitaciones, se reconoce el valor de la excelencia en todo lo que hacen',
            'publicado' => '1'
        ));

        Comment::create(array(
            'id' => 3,
            'nombre' => 'Maria Pilar Ramírez',
            'email' => 'pili.tr@gmail.com',
            'comentario' => 'Su preocupación por los detalles hizo de esta experiencia algo inolvidable. ¡Muchas Gracias!',
            'publicado' => '1'
        ));

        Comment::create(array(
            'id' => 4,
            'nombre' => 'Steve Stevens',
            'email' => 'steve.steves@gmail.com',
            'comentario' => 'This application really rocks!! Thank you very much for create it!!',
            'publicado' => '1'
        ));
    }
}