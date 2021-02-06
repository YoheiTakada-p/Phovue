<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//add
use App\User;
use App\Photo;

class PhotoLikeTest extends TestCase
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
    public function いいねする()
    {
        factory(Photo::class, 5)->create();

        $response = $this->actingAs($this->user)->json('PUT', route('photo.like', [
            'id' => Photo::first()->id
        ]));

        $response->assertStatus(200);
        $this->assertEquals(Photo::first()->like_count, '1');
    }

    /**
     * @test
     */
    public function いいねが1より多く付かないようにする()
    {
        factory(Photo::class, 5)->create();

        Photo::first()->likes()->attach($this->user->id);

        $response = $this->actingAs($this->user)->json('PUT', route('photo.like', [
            'id' => Photo::first()->id
        ]));

        $response->assertStatus(200);
        $this->assertEquals(Photo::first()->like_count, '1');
    }

    /**
     * @test
     */
    public function いいねを削除する()
    {
        factory(Photo::class, 5)->create();

        Photo::first()->likes()->attach($this->user->id);

        $response = $this->actingAs($this->user)->json('DELETE', route('photo.unlike', [
            'id' => Photo::first()->id
        ]));

        $response->assertStatus(200);
        $this->assertEquals(Photo::first()->like_count, '0');
    }
}
