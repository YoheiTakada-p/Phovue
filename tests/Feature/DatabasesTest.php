<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
//add
use App\User;

class DatabasesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function ちゃんとSQLite使えるかテスト()
    {
        $this->user = factory(User::class)->create();

        echo $this->user;
    }
}
