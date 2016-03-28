<?php
class RolesSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        // Main administrator role and permission setting
        $admin = Role::create(array(
            'name' => 'administrator'
        ));

        $p = Permission::where('name','=','administrar_comentarios')->get()->first();
        $admin->attachPermission($p);


        // User roles and permissions setting
        $user = Role::create(array(
            'name' => 'user'
        ));

        $p1 = Permission::where('name', '=', 'editar_datos_personales')->get()->first();
        $p2 = Permission::where('name', '=', 'ingresar_lugares')->get()->first();
        $user->attachPermission($p1);
        $user->attachPermission($p2);

    }
}