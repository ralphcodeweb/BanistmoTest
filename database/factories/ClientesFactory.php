<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Clientes;

class ClientesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombrecompleto' => $this->faker->name(),
            'ingreso' => $this->faker->randomFloat($nbMaxDecimals = 2, $min = 500, $max = 4500),
            'edad' => $this->faker->numberBetween($min = 18, $max = 100),
            'estado' => 'A',
            'id_ciudades' => $this->faker->numberBetween($min = 1, $max = 1)
        ];
    }
}
