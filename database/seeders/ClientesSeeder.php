<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clientes;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clientes::truncate();

        Clientes::factory(50)->create();

        /* $data = [
            [
                'nombrecompleto' => 'Rafel Martinez',
                'ingreso' => 1800.50,
                'edad' => 30,
                'id_ciudades' => 1,
                'estado' => 'A'
            ],
            [
                'nombrecompleto' => 'Karla Gonzalez',
                'ingreso' => 550.00,
                'edad' => 30,
                'id_ciudades' => 1,
                'estado' => 'A'
            ]
        ];

        Clientes::insert($data); */
    }
}
