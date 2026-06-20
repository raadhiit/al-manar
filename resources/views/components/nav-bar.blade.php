@props(['active' => ''])

@php
$navItems = [
    ['key' => 'home',     'label' => 'Beranda',         'href' => route('home')],
    ['key' => 'sekolah',  'label' => 'Sekolah',         'href' => '#', 'children' => [
        ['key' => 'sdit', 'label' => 'SDIT AL MANAR', 'desc' => 'Sekolah Dasar Islam Terpadu', 'href' => route('sdit.index')],
        ['key' => 'tkit', 'label' => 'KB Raudhatul Jannah', 'desc' => 'Kelompok Bermain',       'href' => route('tkit.index')],
        ['key' => 'mdta', 'label' => 'Program MDTA',  'desc' => 'Diniyah Takmiliyah Awaliyah',  'href' => route('sdit.mdta')],
    ]],
    ['key' => 'berita',   'label' => 'Berita',          'href' => route('berita.index')],
    ['key' => 'prestasi', 'label' => 'Prestasi',        'href' => route('prestasi.index')],
    ['key' => 'galeri',   'label' => 'Galeri',          'href' => route('galeri.index')],
    ['key' => 'portal',   'label' => 'Portal Akademik', 'href' => route('portal.kalender')],
    ['key' => 'kontak',   'label' => 'Kontak',          'href' => route('kontak')],
    ];

$sekolahActive = in_array($active, ['sdit', 'tkit']);
@endphp

<header x-data="{ open: false }" style="position:sticky;top:0;z-index:50;">
    {{-- Top bar --}}
    <div style="background:var(--green-800);color:var(--gold-200);font-size:var(--text-xs);font-family:var(--font-sans);">
        <div class="am-container" style="padding-top:7px;padding-bottom:7px;display:flex;align-items:center;">
            <div class="am-topbar-marquee">
                <div class="am-topbar-marquee__track">
                    <span class="am-topbar-marquee__item">
                        <span class="am-arabic" style="font-size:14px;color:var(--gold-300);">السلام عليكم ورحمة الله وبركاته</span>
                        <span style="opacity:.85;">Selamat datang di Yayasan Al Muhajirin AL MANAR Kota Bekasi</span>
                        <span style="opacity:.5;">&middot;</span>
                        <span style="opacity:.85;">082260705227</span>
                        <span style="opacity:.5;">&middot;</span>
                        <span style="opacity:.85;">ppdb@almanar.sch.id</span>
                    </span>
                    <span class="am-topbar-marquee__item" aria-hidden="true">
                        <span class="am-arabic" style="font-size:14px;color:var(--gold-300);">السلام عليكم ورحمة الله وبركاته</span>
                        <span style="opacity:.85;">Selamat datang di Yayasan Al Muhajirin AL MANAR Kota Bekasi</span>
                        <span style="opacity:.5;">&middot;</span>
                        <span style="opacity:.85;">082260705227</span>
                        <span style="opacity:.5;">&middot;</span>
                        <span style="opacity:.85;">ppdb@almanar.sch.id</span>
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Main navbar --}}
    <div style="background:rgba(251,248,241,0.92);backdrop-filter:blur(8px);border-bottom:1px solid var(--border-subtle);">
        <div class="am-container" style="height:var(--navbar-h);display:flex;align-items:center;justify-content:space-between;gap:24px;">

            {{-- Logo --}}
            <a href="{{ route('home') }}" style="display:flex;text-decoration:none;">
                <x-logo tone="dark" :size="42" subtitle="Yayasan · Kota Bekasi" />
            </a>

            {{-- Desktop nav --}}
            <nav class="am-nav-desktop" style="display:flex;align-items:center;gap:26px;">
                @foreach($navItems as $item)
                    @if(!empty($item['children']))
                        <span class="am-nav-dropwrap">
                            <button class="am-nav-link" data-active="{{ $sekolahActive ? 'true' : 'false' }}" style="display:inline-flex;align-items:center;gap:5px;">
                                {{ $item['label'] }}
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="6 9 12 15 18 9"/></svg>
                            </button>
                            <div class="am-nav-drop">
                                @foreach($item['children'] as $child)
                                    <a href="{{ $child['href'] }}" class="am-drop-item">
                                        <span style="width:8px;height:8px;border-radius:50%;background:var(--gold-400);flex-shrink:0;"></span>
                                        <span style="display:flex;flex-direction:column;">
                                            <span style="font-weight:700;font-size:var(--text-sm);color:var(--green-800);">{{ $child['label'] }}</span>
                                            <span style="font-size:var(--text-xs);color:var(--ink-500);">{{ $child['desc'] }}</span>
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </span>
                    @else
                        <a href="{{ $item['href'] }}"
                           class="am-nav-link"
                           data-active="{{ $active === $item['key'] ? 'true' : 'false' }}">
                            {{ $item['label'] }}
                        </a>
                    @endif
                @endforeach
            </nav>

            {{-- CTA + burger --}}
            <div style="display:flex;align-items:center;gap:12px;">
                <span class="am-nav-desktop">
                    <a href="{{ route('sdit.pendaftaran') }}" class="am-btn am-btn--primary am-btn--sm">Daftar Sekarang</a>
                </span>
                <button
                    class="am-burger"
                    aria-label="Buka menu"
                    @click="open = !open">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <g x-show="!open">
                            <line x1="3" y1="6" x2="21" y2="6"/>
                            <line x1="3" y1="12" x2="21" y2="12"/>
                            <line x1="3" y1="18" x2="21" y2="18"/>
                        </g>
                        <g x-show="open">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                        </g>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile menu (Alpine toggle) --}}
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            style="border-top:1px solid var(--border-subtle);background:var(--cream-50);padding:12px var(--gutter) 18px;"
            x-cloak>
            <div class="am-container" style="display:flex;flex-direction:column;gap:4px;">
                @foreach($navItems as $item)
                    @if(!empty($item['children']))
                        @foreach($item['children'] as $child)
                            <a href="{{ $child['href'] }}"
                               class="am-nav-link"
                               style="padding:12px 4px;border-bottom:1px solid var(--border-subtle);">
                                {{ $child['label'] }}
                            </a>
                        @endforeach
                    @else
                        <a href="{{ $item['href'] }}"
                           class="am-nav-link"
                           data-active="{{ $active === $item['key'] ? 'true' : 'false' }}"
                           style="padding:12px 4px;border-bottom:1px solid var(--border-subtle);">
                            {{ $item['label'] }}
                        </a>
                    @endif
                @endforeach
                <div style="margin-top:12px;">
                    <a href="{{ route('sdit.pendaftaran') }}" class="am-btn am-btn--primary am-btn--lg am-btn--block">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</header>
