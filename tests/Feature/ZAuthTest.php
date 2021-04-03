<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ZAuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;
    public function test_login_page()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_register_page()
    {
        $response = $this->get('/register');
        $response->assertStatus(404);
    }
}
