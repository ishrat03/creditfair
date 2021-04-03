<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Companies;

class CompanyTest extends TestCase
{
    //use RefreshDatabase;
    use WithFaker;

    public function test_return_to_login_page_when_not_login()
    {
        $response = $this->get('/company')
                        ->assertRedirect('/login');
    }

    public function test_when_user_logged_in()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
                         ->get('/company')
                         ->assertOk();
    }

    public function test_new_company_add()
    {
        //$this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/company', array(
            'name' => 'Test Company',
            'email' => 'test@creditfair.in',
            'website' => 'website.com',
        ));

        $this->assertGreaterThanOrEqual(1, Companies::count());
    }
}
