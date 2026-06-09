@props([
    'level'    => null,        // SDIT|TKIT|Yayasan
    'category' => 'Berita',
    'date'     => '',
    'title'    => 'Judul berita',
    'excerpt'  => null,
    'image'    => null,
    'href'     => '#',
    'compact'  => false,
])

@php
$levelTone = $level === 'TKIT' ? 'tkit' : ($level === 'SDIT' ? 'sdit' : 'cream');
@endphp

<a href="{{ $href }}" class="am-card" style="display:flex;flex-direction:{{ $compact ? 'row' : 'column' }};gap:{{ $compact ? '16px' : '0' }};text-decoration:none;">
    {{-- Image --}}
    <div style="position:relative;{{ $compact ? 'flex:0 0 132px;' : '' }}">
        @if($image)
            <img src="{{ $image }}" alt="{{ $title }}" style="width:100%;height:{{ $compact ? '100%' : '200px' }};object-fit:cover;display:block;">
        @else
            <div style="width:100%;height:{{ $compact ? '100%' : '200px' }};min-height:100px;background:var(--green-100);display:flex;align-items:center;justify-content:center;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--green-400)" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
            </div>
        @endif
        @if(!$compact && $level)
            <span style="position:absolute;top:14px;left:14px;">
                <x-badge :tone="$levelTone" variant="solid" size="sm">{{ $level }}</x-badge>
            </span>
        @endif
    </div>

    {{-- Body --}}
    <div style="padding:{{ $compact ? '14px 16px 14px 0' : '20px 22px 24px' }};display:flex;flex-direction:column;gap:10px;min-width:0;">
        <div style="display:flex;align-items:center;gap:10px;font-family:var(--font-sans);font-size:var(--text-xs);color:var(--ink-400);">
            @if($compact && $level)
                <x-badge :tone="$levelTone" variant="soft" size="sm">{{ $level }}</x-badge>
            @endif
            @if(!$compact)
                <span style="font-weight:700;color:var(--gold-600);letter-spacing:0.06em;text-transform:uppercase;">{{ $category }}</span>
            @endif
            @if($date)
                <span style="display:inline-flex;align-items:center;gap:5px;">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    {{ $date }}
                </span>
            @endif
        </div>

        <h3 style="font-family:var(--font-display);font-weight:600;font-size:{{ $compact ? 'var(--text-base)' : 'var(--text-lg)' }};line-height:1.3;color:var(--ink-900);margin:0;">
            {{ $title }}
        </h3>

        @if($excerpt && !$compact)
            <p style="font-family:var(--font-sans);font-size:var(--text-sm);line-height:1.6;color:var(--ink-500);margin:0;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                {{ $excerpt }}
            </p>
        @endif

        @if(!$compact)
            <span style="display:inline-flex;align-items:center;gap:6px;margin-top:2px;font-family:var(--font-sans);font-size:var(--text-sm);font-weight:600;color:var(--green-600);">
                Baca selengkapnya
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </span>
        @endif
    </div>
</a>
