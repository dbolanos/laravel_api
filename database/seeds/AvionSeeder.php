<?php

use Illuminate\Database\Seeder;

//HAce uso del modelo de Fabricante
use App\Fabricante;

//Hace uso del modelo Avion
use App\Avion;

//Le indicamos  que utilice tambien Faker
// Información sobre Faker: https://github.com/fzaninotto/Faker
use Faker\Factory as Faker;
class AvionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creamos una instancia de Faker
        $faker = Faker::create();

        //Para cubrir los aviones tenemos que tener en cuentaque fabricantes tenemos.
        //Averiguamos cuantos fabricantes hay en la tabla

        $cuantos = Fabricante::all()->count();

        //Creamos un bucle para crear 20 aviones:

        for($i=0;$i<19;$i++){
            //Cuando llamamos al metodo create del modelo Avion
            //se esta creando una nueva fila en la tabla
            Avion::create(
                [
                    'modelo'=>$faker->word(),
                    'longitud'=>$faker->randomFloat(2,10,150),
                    'capacidad'=>$faker->randomNumber(3), //de 3 digitos como maximo
                    'velocidad'=>$faker->randomNumber(4), //de 4 digitos como maximo
                    'alcance'=>$faker->randomNumber(),
                    'fabricante_id'=>$faker->numberBetween(1,$cuantos)
                ]
            );
        }


    }
}
