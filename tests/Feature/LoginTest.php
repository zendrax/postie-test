<?php

namespace Tests\Feature;

use App\Acme\Http\Instagram;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;
use Tests\Utilities\ModelFactories;

class LoginTest extends TestCase
{
    use ModelFactories, RefreshDatabase;

    /** @test */
    public function it_warns_about_missing_token(): void
    {
        $user = $this->makeUser();

        $this->postJson(route('authorize'))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => 'The given data was invalid.',
            ]);
    }

    /** @test */
    public function registered_user_can_login(): void
    {
        /** @var \Mockery\MockInterface $instagram */
        $instagram = $this->mock(Instagram::class);
        $instagram->shouldReceive('user')->once()->andReturn([
            'username' => 'test',
            'full_name' => 'Test',
        ]);

        $response = $this->postJson(route('authorize'), [
            'token' => str_random(60),
        ]);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertDatabaseMissing('users', [
            'api_token' => null,
        ]);
        $this->getJson(route('user'), [
            'Authorization' => 'Bearer ' . User::first()->api_token,
        ])->assertStatus(Response::HTTP_OK);
    }
}
