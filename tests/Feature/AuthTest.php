<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    /**
     * Login not exists user in the rest application
     * This method use endpoint http://site.local/api/v1/auth/login
     */
    public function testLoginFail()
    {
        $response = $this->post('/api/v1/auth/login', [
            'email' => 'not.exists@gmail.com',
            'password' => '12345678'
        ]);

        $response->assertStatus(422);
    }
}
