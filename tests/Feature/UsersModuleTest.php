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
    public function test_if_edit_user_page_loads()
    {
        $user = factory(User::class)->create();
        $this->get("/usuarios/{$user->id}/editar")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee('Editar usuario')
            ->assertViewHas('user',function($viewUser)use($user){
                return $viewUser -> id === $user -> id;
            });        
    }
    public function test_it_updates_a_user(){
        $user = factory(User::class)->create();
        $this->put("/usuarios/{$user -> id }",[
            'name'=>'Alan',
            'email'=>'alan02n@gmail.com',
            'password'=>'123456'
        ])->assertRedirect("/usuarios/{$user -> id }");
        $this->assertCredentials([
            'name'=>'Alan',
            'email'=>'alan02n@gmail.com',
            'password'=>'123456'
        ]);
    }
    public function test_the_name_is_required_when_updating_a_user(){
        $user = factory(User::class)->create();
        $this->from("usuarios/{$user->id}")
            ->put("usuarios/{$user->id}",[
                'name'=>'',
                'email'=>'alan02n@gmail.com',
                'password'=>'123456'
            ])->assertRedirect("usuarios/{$user->id}/editar")
                ->assertSessionHasErrors(['name']);
        $this->assertDatabaseMissing('users',['email'=>'alan02n@gmail.com']);    
    }

    
  
    public function test_the_email_is_required_when_updating_the_use(){
        $user = factory(User::class)->create();
        $this->from("usuarios/{$user->id}")
            ->put("usuarios/{$user->id}",[
                'name'=>'Alan Jesus',
                'email'=>'correo-no-valido',
                'password'=>'123456'
            ])->assertRedirect("usuarios/{$user->id}/editar")
                ->assertSessionHasErrors(['email']);
        $this->assertDatabaseMissing('users',['name'=>'Alan Jesus']);    
    }
    public function test_the_email_must_be_unique_when_updating_the_user(){
        $randomUser = factory(User::class)->create([
            'email' => 'existing-email@example.com'
        ]);
        $user = factory(User::class)->create([
            'email'=>'alan02n@gmail.com'
        ]);
        $this->from("usuarios/{$user->id}/editar")
            ->put("usuarios/{$user->id}/editar",[
                'name'=>'Alan',
                'email'=>'existing-email@example.com',
                'password'=>'123456'
                ])->assertRedirect("usuarios/{$user->id}/editar")
                ->assertSessionHasErrors(['email']);
        $this->assertEquals(1,User::count());    
    }
    public function test_the_password_is_optional_when_updating_the_user(){
        $old_password = 'CLAVE ANTERIOR';
        $user = factory(User::class)->create([
            'password'=> bcrypt($old_password)
        ]);
    
        $this->from("usuarios/{$user -> id}/editar")
                ->put("usuarios/{$user -> id}",[
                'name'=>'Alan',
                'email'=>'alan02n@gmail.com',
                'password'=>''
            ])->assertRedirect("usuarios/{$user -> id}");
        $this-> assertCredentials([
            'name'=>'Alan Jesus',
            'email'=>'alan02n@gmail.com',
            'password'=>$old_password

        ]);    
    }
    public function test_the_email_is_optional_when_updating_the_user(){
        
        $user = factory(User::class)->create([
            'email'=> 'alan02n@gmail.com'
        ]);
    
        $this->from("usuarios/{$user -> id}/editar")
                ->put("usuarios/{$user -> id}",[
                'name'=>'Alan Jesus',
                'email'=>'alan02n@gmail.com',
                'password'=>'12345678'
            ])->assertRedirect("usuarios/{$user -> id}");
        $this-> assertDatabaseHas([
            'name'=>'Alan Jesus',
            'email'=>'alan02n@gmail.com',           
        ]);    
    }
    public function test_it_deletes_a_user(){
        $user = factory(User::class)->create();
        $this->delete("usuarios/{$user->id}")
            ->assertRedirect("usuarios");
        $this->assertDatabaseMissing('users',[
            'id'=>$user->id
        ]);
    }
}
