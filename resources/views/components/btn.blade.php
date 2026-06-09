@props([
    'variant' => 'primary',   // primary|secondary|outline|ghost|onbrand
    'size'    => 'md',        // sm|md|lg
    'block'   => false,
    'href'    => null,
])

@php
$classes = "am-btn am-btn--{$variant} am-btn--{$size}" . ($block ? ' am-btn--block' : '');
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</button>
@endif
