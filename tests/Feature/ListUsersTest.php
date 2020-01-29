<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListUsersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testUrlUsersRespondWell()
    {
        $response = $this->get('/users');

        $response->assertOK(200);
    }

    public function testEmptyWhenNoUsers()
    {
        $response = $this->getJson('/users');
        $response -> assertHeader('Content-Type', 'application/json');
        $response -> assertExactJson([
            'users' =>[]
        ]);

    }

    public function testEmptyUsers()
    {
        factory(\App\User::class)->create([
            'name' => 'Arthur',
            'email' =>'arthur@hotmail.fr'
        ]);

        $response = $this->getJson('/users');
        $response -> assertHeader('Content-Type', 'application/json');
        $response -> assertExactJson([
            'users' =>[
                'name'=>'Arthur',
                'email'=>'arthur@hotmail.fr'
            ]
        ]);

    }
}
