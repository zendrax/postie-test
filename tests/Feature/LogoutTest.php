<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use Tests\Utilities\ModelFactories;

class LogoutTest extends TestCase
{
    use ModelFactories, RefreshDatabase;

    /** @test */
    public function logged_in_user_can_logout(): void
    {
        $user = $this->createUser();
        $user->api_token = str_random(60);
        $user->save();

        $this->postJson(route('logout'), [], [
            'Authorization' => 'Bearer ' . $user->api_token,
        ])->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas('users', [
            'username' => $user->username,
            'api_token' => null,
        ]);
    }
}
