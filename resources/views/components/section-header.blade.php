@props([
    'eyebrow' => null,
    'title'   => null,
    'lead'    => null,
    'align'   => 'start',   // start|center
    'tone'    => 'default', // default|onbrand
])

@php
$onBrand = $tone === 'onbrand';
$center  = $align === 'center';
$titleColor  = $onBrand ? '#FBF8F1' : 'var(--ink-900)';
$leadColor   = $onBrand ? 'var(--gold-100)' : 'var(--ink-500)';
$eyebrowColor= $onBrand ? 'var(--gold-300)' : 'var(--gold-600)';
@endphp

<div {{ $attributes->merge(['style' => 'display:flex;align-items:flex-end;justify-content:space-between;gap:24px;flex-wrap:wrap;']) }}>
    <div style="display:flex;flex-direction:column;gap:12px;max-width:640px;text-align:{{ $center ? 'center' : 'start' }};{{ $center ? 'margin-inline:auto;' : '' }}align-items:{{ $center ? 'center' : 'flex-start' }};">
        @if($eyebrow)
            <span style="display:inline-flex;align-items:center;gap:8px;font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:{{ $eyebrowColor }};">
                <span style="width:18px;height:2px;background:var(--gold-400);border-radius:2px;flex-shrink:0;"></span>
                {{ $eyebrow }}
            </span>
        @endif
        @if($title)
            <h2 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-3xl);line-height:1.15;letter-spacing:-0.02em;color:{{ $titleColor }};margin:0;">
                {{ $title }}
            </h2>
        @endif
        @if($lead)
            <p style="font-family:var(--font-sans);font-size:var(--text-md);line-height:1.65;color:{{ $leadColor }};margin:0;">
                {{ $lead }}
            </p>
        @endif
    </div>
    @if(isset($action))
        <div style="flex:none;">{{ $action }}</div>
    @endif
</div>
