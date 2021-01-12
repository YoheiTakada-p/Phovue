<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//add
use App\User;

class ResisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function 会員登録()
    {
        $response = $this->json('POST', route('register', [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'testtest',
            'password_confirmation' => 'testtest'
        ]));

        $user = User::first();

        $response->assertStatus(201)
            ->assertJson(['name' => $user->name]);
    }
}
