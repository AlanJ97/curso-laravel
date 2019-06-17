<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_welcomes_users_with_nicknames()
    {
        $response = $this->get('/saludo/alan/pro');
        $response->assertStatus(200);
        $response->assertSee('Tu nombre es : alan y tu apodo es pro');
    }
    public function test_welcomes_users_without_nicknames()
    {
        $response = $this->get('/saludo/alan');
        $response->assertStatus(200);
        $response->assertSee('Tu nombre es alan');
    }
}
