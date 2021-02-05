<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//add
use App\User;
use App\Photo;

use function PHPUnit\Framework\assertJson;

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

        // \Log::debug(Photo::first()->id);
        // \Log::debug(Photo::with(['owner', 'likes'])->first());
        $response->assertStatus(200);
        $this->assertEquals(Photo::first()->like_count, '1');
    }
}
