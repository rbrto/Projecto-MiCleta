<?php
	class UserSeeder extends Seeder {
 
    public function run()
    {
        DB::table('users')->delete();

        // Administrator
        $user = User::create(array(
            'id' => 1,
            'nombre' => 'Richard',
            'apellido' => 'Young',
            'alias' => 'trip',
            'email' => 'admin@gmail.com',
            'direccion' => 'Santiago Chile',
            'edad' => '33',
            'password' => Hash::make('1234'),
            'activo' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        $role = Role::where('name', '=', 'administrator')->get()->first();
        $user->attachRole( $role );

        // A user
        $user = User::create(array(
            'id' => 2,
            'nombre' => 'Francisco',
            'apellido' => 'Young',
            'alias' => 'brother',
            'email' => 'user1@gmail.com',
            'direccion' => 'Santiago Chile',
            'edad' => '17',
            'password' => Hash::make('1234'),
            'activo' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        $role = Role::where('name', '=', 'user')->get()->first();
        $user->attachRole( $role );

        // Another user
        $user = User::create(array(
            'id' => 3,
            'nombre' => 'Steve',
            'apellido' => 'Stevens',
            'alias' => 'Steve',
            'email' => 'user2@gmail.com',
            'direccion' => 'Los Angeles, USA',
            'edad' => '57',
            'password' => Hash::make('1234'),
            'activo' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        $role = Role::where('name', '=', 'user')->get()->first();
        $user->attachRole( $role );

        // And the last one
        $user = User::create(array(
            'id' => 4,
            'nombre' => 'Yngwie James',
            'apellido' => 'Malmsteen',
            'alias' => 'Yngwie',
            'email' => 'user3@gmail.com',
            'direccion' => 'San Diego, USA',
            'edad' => '62',
            'password' => Hash::make('1234'),
            'activo' => '1',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
        ));

        $role = Role::where('name', '=', 'user')->get()->first();
        $user->attachRole( $role );
    }
}