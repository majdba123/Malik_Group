@extends('layouts.admin')

@section('title', __('Site footer'))
@section('heading', __('Site footer'))
@section('subheading', __('About us, contact, and social links on the public site'))

@section('content')
    <div class="max-w-3xl">
        <form action="{{ route('dashboard.site-footer.update') }}" method="POST" class="space-y-8 rounded-2xl border border-slate-200/80 bg-white p-6 sm:p-8 shadow-sm">
            @csrf
            @method('PUT')

            <div>
                <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-500">{{ __('About') }}</h2>
                <p class="mt-1 text-xs text-slate-500">{{ __('Shown in the storefront footer. One row is stored in the database.') }}</p>
            </div>

            <div class="space-y-5">
                <div>
                    <label for="about_heading" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Heading') }} <span class="text-red-500">*</span></label>
                    <input type="text" name="about_heading" id="about_heading" required value="{{ old('about_heading', $footer->about_heading) }}"
                        class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition">
                    @error('about_heading')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="about_body" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Description') }}</label>
                    <textarea name="about_body" id="about_body" rows="5"
                        class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition">{{ old('about_body', $footer->about_body) }}</textarea>
                    @error('about_body')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tagline" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Short tagline') }}</label>
                    <input type="text" name="tagline" id="tagline" value="{{ old('tagline', $footer->tagline) }}" placeholder="{{ __('Optional one line under the heading') }}"
                        class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition">
                    @error('tagline')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Address') }}</label>
                    <textarea name="address" id="address" rows="2" placeholder="{{ __('Optional — showroom or mailing address') }}"
                        class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition">{{ old('address', $footer->address) }}</textarea>
                    @error('address')
                        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="border-t border-slate-100 pt-8 space-y-5">
                <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-500">{{ __('Contact') }}</h2>
                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="contact_email" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Email') }}</label>
                        <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $footer->contact_email) }}"
                            class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition">
                        @error('contact_email')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('Phone (display)') }}</label>
                        <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $footer->contact_phone) }}"
                            class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition font-mono">
                        @error('contact_phone')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="whatsapp" class="block text-sm font-medium text-slate-700 mb-1.5">{{ __('WhatsApp') }}</label>
                        <input type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $footer->whatsapp) }}" placeholder="+1 555 0100 or https://wa.me/…"
                            class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition font-mono">
                        <p class="mt-1 text-xs text-slate-500">{{ __('Phone number or full WhatsApp link.') }}</p>
                        @error('whatsapp')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-8 space-y-5">
                <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-500">{{ __('Social') }}</h2>
                <p class="text-xs text-slate-500">{{ __('Username, @handle, or full URL. We normalize links on the site.') }}</p>
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="instagram" class="block text-sm font-medium text-slate-700 mb-1.5">Instagram</label>
                        <input type="text" name="instagram" id="instagram" value="{{ old('instagram', $footer->instagram) }}" placeholder="username"
                            class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition">
                        @error('instagram')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="tiktok" class="block text-sm font-medium text-slate-700 mb-1.5">TikTok</label>
                        <input type="text" name="tiktok" id="tiktok" value="{{ old('tiktok', $footer->tiktok) }}" placeholder="@brand"
                            class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition">
                        @error('tiktok')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="facebook" class="block text-sm font-medium text-slate-700 mb-1.5">Facebook</label>
                        <input type="text" name="facebook" id="facebook" value="{{ old('facebook', $footer->facebook) }}" placeholder="pagename or URL"
                            class="block w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm shadow-sm focus:border-violet-500 focus:ring-2 focus:ring-violet-500/20 outline-none transition">
                        @error('facebook')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3 border-t border-slate-100 pt-6">
                <button type="submit" class="inline-flex items-center rounded-xl bg-gradient-to-r from-violet-600 to-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md hover:from-violet-500 hover:to-indigo-500 transition">
                    {{ __('Save footer') }}
                </button>
                <a href="{{ route('dashboard') }}" class="text-sm font-semibold text-slate-600 hover:text-slate-900">{{ __('Cancel') }}</a>
            </div>
        </form>
    </div>
@endsection
