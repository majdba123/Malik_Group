<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteFooterSetting extends Model
{
    protected $table = 'site_footer_settings';

    protected $fillable = [
        'about_heading',
        'about_body',
        'tagline',
        'address',
        'contact_email',
        'contact_phone',
        'whatsapp',
        'instagram',
        'tiktok',
        'facebook',
    ];

    public static function instance(): self
    {
        return static::query()->firstOrCreate(
            ['id' => 1],
            [
                'about_heading' => 'About us',
                'about_body' => null,
                'tagline' => null,
                'address' => null,
                'contact_email' => null,
                'contact_phone' => null,
                'whatsapp' => null,
                'instagram' => null,
                'tiktok' => null,
                'facebook' => null,
            ]
        );
    }

    public function whatsappHref(): ?string
    {
        $raw = trim((string) $this->whatsapp);
        if ($raw === '') {
            return null;
        }
        if (preg_match('#^https?://#i', $raw)) {
            return $raw;
        }
        $digits = preg_replace('/\D+/', '', $raw);

        return $digits !== '' ? 'https://wa.me/'.$digits : null;
    }

    public function instagramHref(): ?string
    {
        return $this->socialHref($this->instagram, 'https://instagram.com/');
    }

    public function tiktokHref(): ?string
    {
        $raw = trim((string) $this->tiktok);
        if ($raw === '') {
            return null;
        }
        if (preg_match('#^https?://#i', $raw)) {
            return $raw;
        }
        $h = ltrim($raw, '@/');

        return 'https://www.tiktok.com/@'.$h;
    }

    public function facebookHref(): ?string
    {
        $raw = trim((string) $this->facebook);
        if ($raw === '') {
            return null;
        }
        if (preg_match('#^https?://#i', $raw)) {
            return $raw;
        }

        return 'https://facebook.com/'.ltrim($raw, '/');
    }

    private function socialHref(?string $value, string $prefix): ?string
    {
        $raw = trim((string) $value);
        if ($raw === '') {
            return null;
        }
        if (preg_match('#^https?://#i', $raw)) {
            return $raw;
        }

        return $prefix.ltrim(ltrim($raw, '@/'), '/');
    }
}
