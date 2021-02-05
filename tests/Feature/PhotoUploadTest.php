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

        \Storage::cloud()->assertExists($photo->filename);
    }
    /**
     * @test
     */
    public function DBエラーの場合は写真を保存しない()
    {
        //DBを削除
        \Schema::drop('photos');

        \Storage::fake('s3');

        $response = $this->actingAs($this->user)
            ->json('POST', route('photo.post'), [
                'photo' => UploadedFile::fake()->image('photo.jpg')
            ]);

        $response->assertStatus(500);

        $this->assertEquals(0, count(\Storage::cloud()->files()));
    }
    /**
     * @test
     */
    public function ファイル保存失敗の場合はDBに保存しない()
    {
        //ストレージをモックする
        \Storage::shouldReceive('cloud')->once()->andReturnNull();

        $response = $this->actingAs($this->user)
            ->json('POST', route('photo.post'), [
                'photo' => UploadedFile::fake()->image('photo.jpg')
            ]);

        $response->assertStatus(500);

        $this->assertEmpty(Photo::all());
    }
}
