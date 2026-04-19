<?php

namespace Tests\Feature;

use App\Models\SiteFooterSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteFooterAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_site_footer_editor(): void
    {
        $user = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($user)->get(route('dashboard.site-footer.edit'));

        $response->assertOk();
        $response->assertSee(__('Save footer'), false);
    }

    public function test_admin_can_update_site_footer(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        SiteFooterSetting::query()->create([
            'about_heading' => 'About us',
            'about_body' => 'Old',
            'tagline' => null,
            'address' => null,
            'contact_email' => null,
            'contact_phone' => null,
            'whatsapp' => null,
            'instagram' => null,
            'tiktok' => null,
            'facebook' => null,
        ]);

        $response = $this->actingAs($user)->put(route('dashboard.site-footer.update'), [
            'about_heading' => 'About Malik',
            'about_body' => 'New copy',
            'tagline' => 'Quality furniture',
            'address' => '123 Showroom St',
            'contact_email' => 'info@example.test',
            'contact_phone' => '+1 555 111 2222',
            'whatsapp' => '+15551112222',
            'instagram' => 'malik',
            'tiktok' => '@malik',
            'facebook' => 'malikpage',
        ]);

        $response->assertRedirect(route('dashboard.site-footer.edit'));
        $this->assertDatabaseHas('site_footer_settings', [
            'about_heading' => 'About Malik',
            'contact_email' => 'info@example.test',
        ]);
    }
}
