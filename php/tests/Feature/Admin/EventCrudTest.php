<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Tests\Concerns\SeedsRbac;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Admin;
use App\Models\Event;

/**
 * Characterization tests for admin Event CRUD.
 *
 * Events store a JSON-encoded `content` payload and parsed start/expiry dates,
 * so this suite pins the current validation rules and persistence shape across
 * the Laravel 6 + Carbon behavior changes.
 */
class EventCrudTest extends TestCase
{
    use RefreshDatabase;
    use SeedsRbac;

    private function root()
    {
        return factory(Admin::class)->state('ROOT')->create();
    }

    private function validPayload()
    {
        return [
            'coupon' => 'SUMMER10',
            'content' => [
                'description' => '10% off',
                'products' => [1, 2],
            ],
            // Controller parses with Carbon::createFromFormat('Y-m-d H:i', ...)
            // so the form sends minute precision (no seconds).
            'started_at' => '2026-06-01 00:00',
            'expired_at' => '2026-06-30 00:00',
            'status' => 1,
        ];
    }

    public function test_create_form_renders()
    {
        $this->seedRbac();

        $this->actingAs($this->root(), 'admin')
            ->get('/admin/events/create')
            ->assertSuccessful()
            ->assertViewIs('admin.event.create');
    }

    public function test_store_persists_event_and_flashes_success()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($this->root(), 'admin')
            ->post('/admin/events/create', $this->validPayload())
            ->assertStatus(302)
            ->assertSessionHas('class', 'success');

        $this->assertDatabaseHas('events', ['coupon' => 'SUMMER10']);
    }

    public function test_store_rejects_missing_required_fields()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);

        $this->actingAs($this->root(), 'admin')
            ->post('/admin/events/create', [])
            ->assertStatus(302)
            ->assertSessionHasErrors(['coupon', 'started_at', 'expired_at', 'status']);
    }

    public function test_detail_page_renders_for_existing_event()
    {
        $this->seedRbac();
        $event = Event::create([
            'coupon' => 'WINTER5',
            'content' => json_encode(['description' => 'x', 'products' => [1]]),
            'started_at' => '2026-01-01 00:00:00',
            'expired_at' => '2026-01-31 00:00:00',
            'status' => 1,
        ]);

        $this->actingAs($this->root(), 'admin')
            ->get("/admin/events/{$event->id}/detail")
            ->assertSuccessful()
            ->assertViewIs('admin.event.detail');
    }
}
