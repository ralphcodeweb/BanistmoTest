<?php

namespace Tests\Feature\Clientes;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\Clientes;
use App\Models\User;


class ListarClientesTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function listar_clientes()
    {
        $this->withoutExceptionHandling();

        $usuario = User::factory()->create();
        $clientes = Clientes::factory(10)->create();

        $response =  $this->actingAs($usuario)->get('/api/v1/clientes/');

        if(count($clientes) > 0 ){
            $response->assertStatus(200);
        }else {
            $response->assertStatus(200);
        }
    }

    /** @test */
    public function registrar_clientes()
    {
        //$this->withoutExceptionHandling();

        $usuario = User::factory()->create();

        $userData = [
            'nombrecompleto' => 'Rafael Martinez',
            'ingreso' => 500.00,
            'edad' => 30,
            'id_ciudades' => 1,
            'estado' => 'A'
        ];

        $response =  $this->actingAs($usuario)->json('POST', '/api/v1/clientes/registro', $userData, ['Accept' => 'application/json'])

            ->assertStatus(200);
    }

    /** @test */
    public function cliente_id()
    {
        //$this->withoutExceptionHandling();

        $usuario = User::factory()->create();

        $cliente = Clientes::factory()->make();

        $response =  $this->actingAs($usuario)
                        ->get('/api/v1/clientes/'.$cliente->getRouteKey())
                        ->assertStatus(200);
    }

    /** @test */
    public function update_cliente_id()
    {
       // $this->withoutExceptionHandling();

        $usuario = User::factory()->create();

        $cliente = Clientes::factory()->create();

        $payload = [
            "id" => $usuario->id,
            "nombrecompleto" => "Demo User",
            "ingreso" => "100.00",
            "edad" => "15",
            "id_ciudades" => 1,
            "estado" => "I"
        ];


        $response =  $this->actingAs($usuario)
                        ->put('/api/v1/clientes/update', $payload)
                        ->assertStatus(200);
    }

    /** @test */
    public function delete_cliente_id()
    {
        //$this->withoutExceptionHandling();

        $usuario = User::factory()->create();
        $this->actingAs($usuario);

        $cli = Clientes::factory()->create([
            "nombrecompleto" => "Susan Wojcicki",
            "ingreso" => 1500.00,
            "edad" => "34",
            "id_ciudades" => 1,
            "estado" => "A"
        ]);

        $this->json('DELETE', 'api/v1/clientes/delete/' . $cli->id, [], ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
