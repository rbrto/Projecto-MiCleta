<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

/*
        $this->call('PermisionsSeeder');
        $this->call('RolesSeeder');
        $this->call('UserSeeder');
        $this->call('CommentsSeeder');
        $this->call('PlacesSeeder');
        */
                $this->call('UserSeeder');

        $this->command->info('Basic data processed successfully!');
	}

}
