<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use Tests\Utilities\ModelFactories;

class UserDetailsTest extends TestCase
{
    use ModelFactories, RefreshDatabase;

    /** @test */
    public function guest_can_not_access_user_details_page(): void
    {
        $this->getJson(route('user'))->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function logged_in_user_can_access_user_details_page(): void
    {
        $user = $this->createUser();
        $user->api_token = $token = str_random(60);
        $user->save();
        $this->getJson(route('user'), [
            'Authorization' => 'Bearer ' . $token,
        ])->assertStatus(Response::HTTP_OK);
    }
}
