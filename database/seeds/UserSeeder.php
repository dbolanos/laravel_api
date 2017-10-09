<?php

use Illuminate\Database\Seeder;
use App\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create(
        [
            'email'=>'dbolanos@apitest.com',
            'password' => Hash::make('testtest') //Cifrado de la contraseña testtest
        ]
    );

    }
}
