<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RegistrationTest extends TestCase
{
     use RefreshDatabase; 
    /**
     * A basic feature test example.
     */
    public function test_user_can_register(): void
    {
         $user = User::factory()->make();
         $response = $this->postJson('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
       $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }

    public function test_user_cannot_register_with_invalid_data(): void
    {
         $response = $this->postJson('/register', [
            'name'                  => '',
            'email'                 => '',
            'password'              => '',
            'password_confirmation' => '',
        ]);

        $response->assertStatus(422);
    }
}
