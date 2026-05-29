<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Admin;

/**
 * Characterization tests for the Yajra DataTables JSON endpoints.
 *
 * Every admin list screen is backed by a `Datatables::of(...)->make(true)`
 * endpoint. These run against empty tables (we only assert the response is
 * valid DataTables JSON with a `data` key), which is exactly the signal we
 * need: it proves the Yajra integration still boots after the Laravel 6 +
 * yajra version bump (the package's namespace casing is a known upgrade trap).
 */
class DataTablesTest extends TestCase
{
    use RefreshDatabase;

    private function root()
    {
        return factory(Admin::class)->state('ROOT')->create();
    }

    /** @dataProvider dataTableEndpoints */
    public function test_endpoint_returns_datatables_json($uri)
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        $response = $this->actingAs($this->root(), 'admin')->post($uri);

        $response->assertSuccessful();
        $this->assertArrayHasKey('data', $response->decodeResponseJson());
    }

    public static function dataTableEndpoints()
    {
        return [
            'products' => ['/admin/products/getProductsData'],
            'orders'   => ['/admin/orders/getOrdersData'],
            'news'     => ['/admin/news/getNewsData'],
            'events'   => ['/admin/events/getEventsData'],
            'users'    => ['/admin/users/getUsersData'],
            'accounts' => ['/admin/account_setting/getAccountsData'],
            'roles'    => ['/admin/account_setting/getRolesData'],
        ];
    }
}
