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

        $this->user = factory(User::class)->create();
    }

    /**
     * @test
     */
    public function 写真を削除する()
    {
        factory(Photo::class)->create([
            'user_id' => $this->user->id
        ]);

        $photo = Photo::first();

        $photo->likes()->attach($this->user->id);

        $comment = new Comment(['comment' => 'sampleTest']);

        $photo->comment()->save($comment);

        \Log::debug(Photo::with(['owner', 'likes', 'comment'])->first());

        $response = $this->actingAs($this->user)->json('DELETE', route('photo.delete', [
            'id' => Photo::first()->id
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
