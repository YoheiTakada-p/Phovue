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
    /**
     * @test
     */
    public function 会員登録_validationTest_文字以外()
    {
        $obj = ['obj' => 'obj'];
        $response = $this->json('POST', route('register', [
            'name' => $obj,
            'email' => 'test@example.com',
            'password' => 'testtest',
            'password_confirmation' => 'testtest'
        ]));

        $response->assertStatus(422);
    }
    /**
     * @test
     */
    public function 会員登録_validationTest_パスワード4文字以下はダメ()
    {
        $response = $this->json('POST', route('register', [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => '1234',
            'password_confirmation' => '1234'
        ]));

        $response->assertStatus(422);
    }
    /**
     * @test
     */
    public function 会員登録_validationTest_byte数が255以上()
    {
        $mozi = '';

        for ($i = 0; $i < 256; $i++) {
            $mozi .= 'a';
        }

        $response = $this->json('POST', route('register', [
            'name' => $mozi,
            'email' => 'test@example.com',
            'password' => '12345',
            'password_confirmation' => '12345'
        ]));

        $response->assertStatus(422);
    }
}
