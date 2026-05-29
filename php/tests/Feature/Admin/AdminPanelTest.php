<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Tests\Concerns\SeedsRbac;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Admin;

/**
 * Characterization tests for the admin panel pages.
 *
 * Two jobs:
 *  - Auth gating: every /admin page redirects unauthenticated visitors to login.
 *  - View rendering: a ROOT admin can load each list/form page (200 + expected
 *    view). These pages render the `adminlte::` layout, so this suite is the
 *    primary regression net for the AdminLTE v1 -> v3 (Bootstrap 4) migration:
 *    if the layout breaks, these 200s turn into 500s.
 */
class AdminPanelTest extends TestCase
{
    use RefreshDatabase;
    use SeedsRbac;

    private function root()
    {
        return factory(Admin::class)->state('ROOT')->create();
    }

    /** @dataProvider guardedPages */
    public function test_guest_is_redirected_to_login($uri)
    {
        $this->get($uri)->assertRedirect('/admin/login');
    }

    public function guardedPages()
    {
        return [
            'dashboard' => ['/admin'],
            'products'  => ['/admin/products'],
            'orders'    => ['/admin/orders'],
            'news'      => ['/admin/news'],
            'events'    => ['/admin/events'],
            'users'     => ['/admin/users'],
        ];
    }

    /** @dataProvider listPages */
    public function test_root_admin_can_load_page($uri, $view)
    {
        $this->seedRbac();

        $this->actingAs($this->root(), 'admin')
            ->get($uri)
            ->assertSuccessful()
            ->assertViewIs($view);
    }

    public function listPages()
    {
        return [
            'dashboard'     => ['/admin', 'admin.dashboard'],
            'product list'  => ['/admin/products', 'admin.product.list'],
            'order list'    => ['/admin/orders', 'admin.order.list'],
            'news list'     => ['/admin/news', 'admin.news.list'],
            'event list'    => ['/admin/events', 'admin.event.list'],
            'user list'     => ['/admin/users', 'admin.user.list'],
            'news create'   => ['/admin/news/create', 'admin.news.create'],
            'event create'  => ['/admin/events/create', 'admin.event.create'],
            'user create'   => ['/admin/users/create', 'admin.user.create'],
        ];
    }
}
