<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//add
use App\User;
use App\Photo;

class PhotoUploadTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }
    /**
     *@test
     */
    public function 写真を投稿できる()
    {
        $response = $this->actingAs($this->user)
            ->json('POST', route('photo.post'));

        $response->assertStatus(200);
    }
}
