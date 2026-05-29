<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Characterization tests for the public storefront.
 *
 * Captures the current (Laravel 5.8) behavior of the public-facing pages so the
 * framework / AdminLTE / Bootstrap modernization can be verified against a known
 * baseline. These pages render the storefront blade layout; a 200 here means the
 * view chain still compiles.
 */
class StorefrontTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_renders()
    {
        $this->get('/')
            ->assertSuccessful()
            ->assertViewIs('home.index');
    }

    // NOTE: /category currently throws "Undefined index: products" in
    // category/index.blade.php (the storefront is half-built: /cart and
    // /member/info return dd()). Characterizing it as 200 would encode a bug,
    // so it is intentionally not covered until the storefront is finished.

    public function test_product_detail_renders()
    {
        $this->get('/product/1')
            ->assertSuccessful()
            ->assertViewIs('product.index');
    }

    public function test_customer_service_contact_renders()
    {
        $this->get('/cs/contact')
            ->assertSuccessful()
            ->assertViewIs('cs.contact');
    }

    public function test_customer_service_faqs_renders()
    {
        $this->get('/cs/faqs')
            ->assertSuccessful()
            ->assertViewIs('cs.faqs');
    }

    public function test_member_area_requires_authentication()
    {
        $this->get('/member')->assertRedirect('/login');
    }
}
