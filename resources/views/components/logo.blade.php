@props([
    'variant'     => 'full',   // full | mark | stacked
    'tone'        => 'dark',   // dark | light
    'size'        => 44,
    'subtitle'    => 'Yayasan · Kota Bekasi',
    'showArabic'  => false,
])

@php
$light     = $tone === 'light';
$wordColor = $light ? '#FBF8F1' : 'var(--green-700)';
$subColor  = $light ? 'var(--gold-300)' : 'var(--ink-500)';
$markBg    = $light ? 'none' : '#155742';
$stacked   = $variant === 'stacked';
@endphp

@php $mark = ''; @endphp

{{-- Emblem SVG --}}
<span style="display:inline-flex;{{ $stacked ? 'flex-direction:column;' : 'flex-direction:row;' }}align-items:center;gap:{{ $stacked ? '10px' : '12px' }};">
    <svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 64 64" aria-label="AL MANAR" style="flex:none;display:block;">
        <rect x="0" y="0" width="64" height="64" rx="16" fill="{{ $markBg }}" />
        <g fill="none" stroke="#D9AB3D" stroke-width="2.4" stroke-linejoin="round">
            <rect x="13" y="13" width="38" height="38" />
            <path d="M32 7 L57 32 L32 57 L7 32 Z" />
        </g>
        <polygon points="43.1,36.6 36.6,43.1 27.4,43.1 20.9,36.6 20.9,27.4 27.4,20.9 36.6,20.9 43.1,27.4" fill="#D9AB3D" fill-opacity="0.18" />
        <path d="M32 22 C27 22 27 28 27 34 L27 42 L37 42 L37 34 C37 28 37 22 32 22 Z" fill="#FBF8F1" />
        <circle cx="32" cy="18.5" r="2.6" fill="#D9AB3D" />
    </svg>

    @if($variant !== 'mark')
        <span style="display:flex;flex-direction:column;line-height:1;align-items:{{ $stacked ? 'center' : 'flex-start' }};">
            <span style="display:inline-flex;align-items:baseline;gap:8px;">
                <span style="font-family:var(--font-display);font-weight:700;font-size:{{ $size * 0.5 }}px;letter-spacing:0.02em;color:{{ $wordColor }};">
                    AL MANAR
                </span>
                @if($showArabic)
                    <span class="am-arabic" style="font-size:{{ $size * 0.62 }}px;color:{{ $light ? 'var(--gold-300)' : 'var(--green-600)' }};">
                        المنار
                    </span>
                @endif
            </span>
            @if($subtitle)
                <span style="font-family:var(--font-sans);font-size:{{ max(9, $size * 0.21) }}px;letter-spacing:0.16em;text-transform:uppercase;color:{{ $subColor }};margin-top:5px;">
                    {{ $subtitle }}
                </span>
            @endif
        </span>
    @endif
</span>
