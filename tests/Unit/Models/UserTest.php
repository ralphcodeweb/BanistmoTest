<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function intento_emil_password()
    {
        //$this->withoutExceptionHandling();

        $this->json('POST', 'api/v1/login')
            ->assertStatus(422)
            ->assertSessionMissing('email', 'password');
    }


    /** @test */
    public function usuario_credenciales_correctas()
    {
        //$this->withoutExceptionHandling();

        $user = User::factory()->create([
           'email' => 'sample@test.com',
           'password' => bcrypt('sample123'),
        ]);


        $loginData = ['email' => 'sample@test.com', 'password' => 'sample123'];

        $response = $this->json('POST', 'api/v1/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200);

        $this->assertAuthenticated();
    }

}
