<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginTest extends TestCase
{
     use RefreshDatabase; 
    /**
     * A basic feature test example.
     */
    public function test_user_can_login(): void
    {
         $user = User::factory()->create([
            'name' => fake()->name(),
            'email' => fake()->email(),
            'password' => Hash::make('password'),
            'is_blocked' => false,
         ]);

        $response = $this->postJson('/login', [
            'email'    => $user->email,
            'password' => 'password',
        ]);

 
        $this->assertAuthenticatedAs($user);

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);
    }


      public function test_user_cannot_login_with_invalid_data(): void
    {
         $response = $this->postJson('/login', [
            'email'                 => '',
            'password'              => '',
           
        ]);

        $response->assertStatus(422);
    }
}
