<?php

class PermisionsSeeder extends Seeder {
 
    public function run()
    {
        // Admin permissions
        $p = new Permission();
        $p->name = 'administrar_comentarios';
        $p->display_name = 'Administrar Comentarios';
        $p->save();

        // User permissions
        $p = new Permission();
        $p->name = 'editar_datos_personales';
        $p->display_name = 'Editar Datos Personales';
        $p->save();

        $p = new Permission();
        $p->name = 'ingresar_lugares';
        $p->display_name = 'Ingresar Lugares (Tiendas y Estacionamientos)';
        $p->save();
    }
    
}