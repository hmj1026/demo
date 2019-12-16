<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Admin;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_login_form()
    {
        $response = $this->get('/admin/login');

        $response->assertSuccessful();
    }

    public function test_admin_can_login()
    {
        $admin  = factory(Admin::class)->create();

        $this->startSession();

        $response = $this->post(route('admin.login'), [
            '_token' => \csrf_token(),
            'account' => $admin->account,
            'password' => 'password',
        ]);
   
        $this->assertAuthenticatedAs($admin, 'admin');

        $response->assertStatus(302);
        $response->assertRedirect('/admin');
        
        return $admin;
    }

    public function test_no_login_admin_cant_see_admin_dashboard()
    {
        $this->get(route('admin.dashboard'))->assertRedirect('/admin/login');
    }
}
