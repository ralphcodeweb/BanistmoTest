<?php

namespace Tests\Unit\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Clientes;
use App\Models\Servicios;

class ServiciosTest extends TestCase
{

    use RefreshDatabase, WithFaker;

    /** @test */
    public function servicio_cuenta()
    {
        $this->withoutExceptionHandling();

        $cliente = Clientes::factory()->make([
            'nombrecompleto' => 'Rafael Martinez',
            'edad' => 30,
            'ingreso' => null,
            'id_ciudades' => 1,
            'estado' => 'A'
        ]);

        $servicios = Servicios::factory()->make([
            'descripcion' => 'Cuentas',
            'ingreso' => null,
            'edad' => 18,
            'id_ciudades' => 1
        ]);

        $response = $this->get('/api/v1/clientes/servicios/'.$cliente->id)
        ->assertStatus(200)
        /* ->assertSee([
            'cliente' => [
                'nombre' => $cliente->nombrecompleto,
                'edad' => $cliente->edad,
                'ingreso' => $cliente->ingreso,
                'id_ciudades' => $cliente->id_ciudades,
                'estado' => $cliente->estado,
            ],
            'servicios' => $servicios,
            'code' => 200
        ]) */;
    }

}
