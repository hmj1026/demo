<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Admin;
use Auth;

class ManageTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_change_password_fails()
    {
        $admin  = factory(Admin::class)->create();

        $this->startSession();
        
        $response = $this->actingAs($admin, 'admin')->patch('/admin/account_setting/password', [
            '_token' => \csrf_token(),
        ]);
        
        $response->assertStatus(302)->assertSessionHasErrors();
    }

    public function test_admin_root_can_change_password()
    {
        $admin  = factory(Admin::class)->state('ROOT')->create();

        $this->startSession();

        $response = $this->actingAs($admin, 'admin')->patch('/admin/account_setting/password', [
            '_token' => \csrf_token(),
            'password' => 'new_password',
            'password_confirmation' => 'new_password'
        ]);
        
        $response->assertStatus(302)->assertSessionHas('class', 'success');
        $authenticated = \Auth::attempt(['account' => $admin->account , 'password' => 'new_password']);
        $this->assertTrue($authenticated);
    }
}
