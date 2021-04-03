<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Employees;

class EmployeeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    //use WithFaker;
    //use RefreshDatabase;
    public function test_employee_index_without_login()
    {
        $response = $this->get('/employee');

        $response->assertStatus(302);
    }

    public function test_employee_index_with_login()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
                         ->get('/company')
                         ->assertOk();
    }

    public function test_new_employee_add()
    {
        //$this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/employee', array(
            'first_name' => 'Test',
            'last_name' => 'Employee',
            'email' => 'test@creditfair.in',
            'company_id' => 1,
            'phone' => '9347384758'
        ));

        $this->assertGreaterThanOrEqual(1, Employees::count());
    }
}
