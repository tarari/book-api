<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    function test_user_can_login_and_receive_token()
    {
        $user = User::factory()->create([
            'email' => 'test@book.com',
            'password' => bcrypt('secret123')
        ]);
        $response=$this->postJson('/api/login',[
            'email' => 'test@book.com',
            'password' => 'secret123'
        ]);
        $response->assertStatus(200)
            ->assertJsonStructure(['data'=>['token','user']])
            ->assertJsonPath('data.user.email', 'test@book.com');
    }
    function test_login_fails_with_wrong_credentials(){
        $user = User::factory()->create([
            'email' => 'test@book.com',
            'password' => bcrypt('secret123')
        ]);
        $response=$this->postJson('/api/login',[
            'email' => 'test@book.com',
            'password' => 'wrong-password'
        ]);
        $response->assertStatus(401);
    }
}
