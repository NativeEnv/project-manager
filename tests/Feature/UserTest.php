<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;

class UserTest extends TestCase
{
    /**
     * Create user test
     * This method do a request to endpoint http://site.local/api/v1/users
     * endpoint must be response 201 created status
     */
    public function testCreate()
    {
        $password = Str::random(8);

        $response = $this->post('/api/v1/users', [
            'name'                  => Str::random(8),
            'email'                 => Str::random(8) . '@gmail.com',
            'password'              => $password,
            'password_confirmation' => $password
        ]);

        $response->assertStatus(201);
    }

    /**
     * Create user with not valid data
     * This method do a request to endpoint http://site.local/api/v1/users with not valid data
     */
    public function testCreateNotValidUser()
    {
        $response = $this->post('/api/v1/users', [
            'name'                  => 'A',
            'email'                 => Str::random(8),
            'password'              => '123',
            'password_confirmation' => '12345678'
        ]);

        $response->assertStatus(422);
    }
}
