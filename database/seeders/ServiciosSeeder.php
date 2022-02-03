<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicios;

class ServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Servicios::truncate();

        $factores = [
            [
                'descripcion' => 'Cuentas',
                'ingreso' => null,
                'edad' => 18,
                'id_ciudades' => 1,
            ],
            [
                'descripcion' => 'Tarjeta de Debito',
                'ingreso' => 500,
                'edad' => 18,
                'id_ciudades' => 1,
            ],
            [
                'descripcion' => 'Seguro',
                'ingreso' => 1000,
                'edad' => 15,
                'id_ciudades' => 1,
            ],
            [
                'descripcion' => 'Inversiones',
                'ingreso' => 4500,
                'edad' => 25,
                'id_ciudades' => 1,
            ],
            [
                'descripcion' => 'Giros',
                'ingreso' => null,
                'edad' => null,
                'id_ciudades' => 1,
            ]
        ];

        Servicios::insert($factores);
    }
}
