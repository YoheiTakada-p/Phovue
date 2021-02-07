<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//add
use App\User;
use App\Photo;
use App\Comment;

class PhotoDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        factory(Comment::class, 5)->create();

        $this->user = User::first();
    }

    /**
     * @test
     */
    public function 写真を削除する()
    {
        $photo = Photo::first();

        $photo->likes()->attach($this->user->id);

        $response = $this->actingAs($this->user)->json('DELETE', route('photo.delete', [
            'id' => $photo->id
        ]));

        $response->assertStatus(200);

        $this->assertDatabaseMissing('photos', [
            'id' => $photo->id,
        ]);

        $this->assertDatabaseMissing('likes', [
            'photo_id' => $photo->id,
        ]);

        $this->assertDatabaseMissing('comments', [
            'photo_id' => $photo->id,
        ]);
    }
}
