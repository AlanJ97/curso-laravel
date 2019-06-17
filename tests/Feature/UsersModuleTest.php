<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_users_page_loads()
    {
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Home usuarios');        
    }
    public function test_if_users_details_page_loads()
    {
        $this->get('/usuarios/5')
            ->assertStatus(200)
            ->assertSee('Mostrando detalles del usuario : 5');        
    }
    public function test_if_new_user_page_loads()
    {
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Creando al usuario');        
    }
}
