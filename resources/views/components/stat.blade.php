@props([
    'value'    => '',
    'label'    => '',
    'sublabel' => null,
    'align'    => 'start',    // start|center
    'tone'     => 'green',    // green|gold|onbrand
])

@php
$valueColor = match($tone) {
    'gold'    => 'var(--gold-500)',
    'onbrand' => '#FBF8F1',
    default   => 'var(--green-700)',
};
$labelColor = $tone === 'onbrand' ? '#FBF8F1' : 'var(--ink-700)';
$subColor   = $tone === 'onbrand' ? 'var(--gold-200)' : 'var(--ink-500)';
$alignStyle = $align === 'center' ? 'align-items:center;text-align:center;' : 'align-items:flex-start;';
@endphp

<div style="display:flex;flex-direction:column;gap:4px;{{ $alignStyle }}">
    <span style="font-family:var(--font-display);font-weight:700;font-size:var(--text-4xl);line-height:1;letter-spacing:-0.02em;color:{{ $valueColor }};">
        {{ $value }}
    </span>
    <span style="font-family:var(--font-sans);font-weight:600;font-size:var(--text-sm);color:{{ $labelColor }};">
        {{ $label }}
    </span>
    @if($sublabel)
        <span style="font-family:var(--font-sans);font-size:var(--text-xs);color:{{ $subColor }};">
            {{ $sublabel }}
        </span>
    @endif
</div>
