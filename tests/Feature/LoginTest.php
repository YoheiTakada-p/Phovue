<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//add
use App\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }
    /**
     * @test
     */
    public function ログイン()
    {
        $response = $this->json('POST', route('login', [
            'email' => $this->user->email,
            'password' => 'password'
        ]));

        $response->assertStatus(200)
            //レスポンスが指定したjsonデータを持っているか
            ->assertJson(['name' => $this->user->name]);
        //レスポンスが認証されているか
        $this->assertAuthenticatedAs($this->user);
    }
    /**
     * @test
     */
    public function ログイン_validationTest_入力なし()
    {
        $response = $this->json('POST', route('login', [
            'email' => '',
            'name' => ''
        ]));

        $response->assertStatus(422);
    }
}
