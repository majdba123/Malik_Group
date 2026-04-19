<?php

namespace Database\Seeders;

use App\Models\SiteFooterSetting;
use Illuminate\Database\Seeder;

class SiteFooterSettingSeeder extends Seeder
{
    public function run(): void
    {
        SiteFooterSetting::query()->updateOrCreate(
            ['id' => 1],
            [
                'about_heading' => 'About us',
                'about_body' => 'Malik Group curates furniture and interiors with warm materials, honest pricing, and showroom-quality pieces for living, dining, bedroom, and workspace. Reach us on social or WhatsApp for orders and advice.',
                'tagline' => 'Furniture & interiors you will enjoy every day.',
                'address' => null,
                'contact_email' => 'hello@malikgroup.example',
                'contact_phone' => '+1 (555) 100-2000',
                'whatsapp' => '+15551002000',
                'instagram' => 'malikgroup',
                'tiktok' => '@malikgroup',
                'facebook' => 'malikgroup',
            ]
        );
    }
}
