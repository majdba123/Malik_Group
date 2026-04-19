<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteFooterSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteFooterSettingController extends Controller
{
    public function edit(): View
    {
        $footer = SiteFooterSetting::instance();

        return view('admin.site-footer.edit', compact('footer'));
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'about_heading' => ['required', 'string', 'max:120'],
            'about_body' => ['nullable', 'string', 'max:5000'],
            'tagline' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:1000'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:64'],
            'whatsapp' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'tiktok' => ['nullable', 'string', 'max:255'],
            'facebook' => ['nullable', 'string', 'max:255'],
        ]);

        SiteFooterSetting::instance()->update($data);

        return redirect()->route('dashboard.site-footer.edit')->with('success', __('Footer and about section updated.'));
    }
}
