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
    public function test_it_displays_user_details()
    {
        $user = factory(User::class)->create([
            'name'=>'Alan Jesús'
        ]);
        $this->get('/usuarios/'.$user->id)
            ->assertStatus(200)
            ->assertSee('Alan Jesús');        
    }
    public function test_if_new_user_page_loads()
    {
        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Creando al usuario');        
    }
    public function test_it_displays_a_4004_error_if_users_is_not_founded(){
        $this->get('/usuarios/9999')
            ->assertStatus(404)
            ->assertSee('Usuano no encontrado');
    }
    public function test_it_creates_a_new_user(){
        $this->post('usuarios/store',[
            'name'=>'Alan',
            'email'=>'alan02n@gmail.com',
            'password'=>'123456'
        ])->assertRedirect('usuarios');
        $this->assertCredentials([
            'name'=>'Alan',
            'email'=>'alan02n@gmail.com',
            'password'=>'123456'
        ]);
    }
    public function test_the_name_is_required(){
        $this->from('usuarios/nuevo')->post('/usuarios/',[
            'name'=>'',
            'email'=>'alan02n@gmail.com',
            'password'=>'123456'
         ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['name'=>'El campo nombre es obligatorio']);
        $this->assertEquals(0,User::count());    
    }
    public function test_the_email_is_required(){
        $this->from('usuarios/nuevo')->post('/usuarios/',[
            'name'=>'Alan',
            'email'=>'',
            'password'=>'123456'
         ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);
        $this->assertEquals(0,User::count());    
    }
    public function test_the_password_is_required(){
        $this->from('usuarios/nuevo')->post('/usuarios/',[
            'name'=>'Alan',
            'email'=>'alan02n@gmail.com',
            'password'=>''
         ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['password']);
        $this->assertEquals(0,User::count());    
    }
    public function test_the_email_must_be_valid(){
        $this->from('usuarios/nuevo')->post('/usuarios/',[
            'name'=>'Alan',
            'email'=>'Correo-no-valido',
            'password'=>'123456'
         ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);
        $this->assertEquals(0,User::count());    
    }
    public function test_the_email_must_be_unique(){
        factory(User::class)->create([
            'email'=>'alan02n@gmail.com'
        ]);
        $this->from('usuarios/nuevo')->post('/usuarios/',[
            'name'=>'Alan',
            'email'=>'alan02n@gmail.com',
            'password'=>'123456'
         ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);
        $this->assertEquals(1,User::count());    
    }
}
