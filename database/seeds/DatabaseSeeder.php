<?php

use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('FabricanteSeeder');
        $this->call('AvionSeeder');
        // $this->call(UsersTableSeeder::class);

        // Solo queremos un único usuario en la tabla, así que truncamos primero la tabla
        // Para luego rellenarla con los registros.
        User::truncate();

        //Llamamos al seeder de Users.
        $this->call('UserSeeder');
    }
}
