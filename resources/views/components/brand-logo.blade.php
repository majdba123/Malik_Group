@props([
    'variant' => 'dark',
])

@php
    $primary = $variant === 'light' ? '#fafaf9' : '#1c1917';
    $accent = $variant === 'light' ? '#fcd34d' : '#b45309';
@endphp

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 48" fill="none" {{ $attributes }} role="img" aria-label="{{ config('app.name') }}">
    <text x="0" y="34" font-family="Cormorant Garamond, Georgia, 'Times New Roman', serif" font-size="36" font-weight="600" fill="{{ $primary }}">Malik</text>
    <text x="2" y="46" font-family="Outfit, system-ui, sans-serif" font-size="7.5" font-weight="600" fill="{{ $accent }}" letter-spacing="0.42em">GROUP</text>
</svg>
