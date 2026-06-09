@props([
    'tone'    => 'green',   // green|gold|cream|success|info|danger|sdit|tkit
    'variant' => 'soft',    // soft|solid|outline
    'size'    => 'md',      // sm|md
])

<span {{ $attributes->merge(['class' => "am-badge am-badge--{$size} am-badge--{$tone}-{$variant}"]) }}>
    {{ $slot }}
</span>
