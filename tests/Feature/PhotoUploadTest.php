<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//add
use App\User;
use App\Photo;
use Illuminate\Http\UploadedFile;

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
        \Storage::fake('s3');

        $response = $this->actingAs($this->user)
            ->json('POST', route('photo.post'), [
                'photo' => UploadedFile::fake()->image('photo.jpg')
            ]);

        $response->assertStatus(201);

        $photo = Photo::first();
        \Log::debug($response->content());
    }
}
