<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//add
use App\Photo;
use App\User;

class PhotoGetTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function 写真を取得できる()
    {
        factory(Photo::class, 5)->create();

        echo Photo::with(['owner'])->first();

        $response = $this->json('GET', route('photo.get'));

        // \Log::debug($response->content());
        $response->assertStatus(200);
    }
}
