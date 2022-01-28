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
                'ingresos' => null,
                'edad' => 18,
                'cod_ciudad' => 1,
            ],
            [
                'descripcion' => 'Tarjeta de Debito',
                'ingresos' => 500,
                'edad' => 18,
                'cod_ciudad' => 1,
            ],
            [
                'descripcion' => 'Seguro',
                'ingresos' => 1000,
                'edad' => 15,
                'cod_ciudad' => 1,
            ],
            [
                'descripcion' => 'Inversiones',
                'ingresos' => 4500,
                'edad' => 25,
                'cod_ciudad' => 1,
            ]
        ];

        Servicios::insert($factores);
    }
}
