<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//add
use App\User;

class UserTest extends TestCase
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
    public function ログインしてたらログイン情報を返却()
    {
        $response = $this->actingAs($this->user)->json('GET', route('user'));
        // \Log::debug($response->content());
        $response->assertStatus(200)->assertJson(['name' => $this->user->name]);
    }
    /**
     * @test
     */
    public function ログインしてなかったら空文字を返却()
    {
        $response = $this->json('GET', route('user'));

        $response->assertStatus(200);
        $this->assertEquals('', $response->content());
    }
}
