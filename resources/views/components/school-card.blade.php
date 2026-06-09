@props([
    'level'         => 'SDIT',
    'name'          => 'SDIT AL MANAR',
    'tagline'       => 'Sekolah Dasar Islam Terpadu',
    'description'   => null,
    'ageRange'      => '7–12 tahun',
    'accreditation' => 'A',
    'points'        => [],
    'image'         => null,
    'href'          => '#',
])

@php
$isTkit = $level === 'TKIT';
$accent = $isTkit ? 'var(--gold-400)' : 'var(--green-600)';
$btnVar = $isTkit ? 'secondary' : 'primary';
$tone   = $isTkit ? 'tkit' : 'sdit';
@endphp

<article style="display:flex;flex-direction:column;background:var(--surface-card);border:1px solid var(--border-default);border-radius:var(--radius-xl);overflow:hidden;box-shadow:var(--shadow-sm);">
    {{-- Media --}}
    <div style="position:relative;">
        @if($image)
            <img src="{{ $image }}" alt="{{ $name }}" style="width:100%;height:210px;object-fit:cover;display:block;">
        @else
            <div style="width:100%;height:210px;background:{{ $isTkit ? 'var(--gold-100)' : 'var(--green-100)' }};display:flex;align-items:center;justify-content:center;">
                <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="{{ $isTkit ? 'var(--gold-500)' : 'var(--green-400)' }}" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
        @endif
        <span style="position:absolute;top:16px;left:16px;">
            <x-badge :tone="$tone" variant="solid" size="md">{{ $level }}</x-badge>
        </span>
        <span style="position:absolute;top:16px;right:16px;">
            <x-badge tone="cream" variant="solid" size="md">Akreditasi {{ $accreditation }}</x-badge>
        </span>
    </div>

    {{-- Content --}}
    <div style="padding:26px 26px 28px;display:flex;flex-direction:column;gap:14px;">
        <div style="display:flex;flex-direction:column;gap:4px;">
            <span style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:var(--ink-400);">
                {{ $tagline }}
            </span>
            <h3 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-2xl);color:var(--ink-900);margin:0;">
                {{ $name }}
            </h3>
        </div>

        @if($description)
            <p style="font-family:var(--font-sans);font-size:var(--text-base);line-height:1.65;color:var(--ink-500);margin:0;">
                {{ $description }}
            </p>
        @endif

        @if(count($points))
            <ul style="list-style:none;margin:4px 0 0;padding:0;display:flex;flex-direction:column;gap:9px;">
                @foreach($points as $point)
                    <li style="display:flex;gap:10px;align-items:flex-start;font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="{{ $accent }}" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" style="flex:none;margin-top:1px;"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ $point }}
                    </li>
                @endforeach
            </ul>
        @endif

        <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;margin-top:8px;padding-top:18px;border-top:1px solid var(--border-subtle);">
            <span style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-500);">
                Usia <strong style="color:var(--ink-900);">{{ $ageRange }}</strong>
            </span>
            <a href="{{ $href }}" class="am-btn am-btn--{{ $btnVar }} am-btn--sm">Profil Sekolah</a>
        </div>
    </div>
</article>
