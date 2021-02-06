<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//add
use App\Photo;
use App\Comment;

class PhotoGetTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function 写真とコメントを取得できる()
    {
        factory(Comment::class, 5)->create();

        $response = $this->json('GET', route('photo.get'));

        \Log::debug($response->content());

        $response->assertStatus(200)
            ->assertJsonFragment([
                'like_count' => 0,
                'liked_by_user' => false,
                'user_comment' => Photo::first()->user_comment
            ]);
    }
}
