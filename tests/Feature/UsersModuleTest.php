<?php

namespace Tests\Feature;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersModuleTest extends TestCase
{
    use RefreshDatabase;    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_if_users_list_loads_with_data()
    {
        factory(User::class)->create([
            'name'=>'Joel'     
        ]);
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Joel');        
    }
    public function test_if_users_list_is_empty()
    {
        // DB::table('users')->truncate();
        $this->get('/usuarios')
            ->assertStatus(200)
            ->assertSee('Home usuarios')
            ->assertSee('La lista no tiene ningun dato');               
    }
    public function test_if_users_details_page_loads()
    {
        $this->get('/usuarios/5')
            ->assertStatus(200)
            ->assertSee('Mostrando detalles del usuario :');        
    }
    public function test_if_new_user_page_loads()
    {
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Creando al usuario');        
    }
}
