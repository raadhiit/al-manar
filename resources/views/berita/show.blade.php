<x-layouts.app
    navActive="berita"
    :title="$berita->title"
    :description="Str::limit(strip_tags($berita->body ?? ''), 160)"
>

    {{-- ── Hero/Breadcrumb ─────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);padding:28px 0;">
        <div class="am-container">
            <nav style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--gold-200);display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                <a href="{{ route('home') }}" style="color:var(--gold-200);text-decoration:none;opacity:.75;">Beranda</a>
                <span style="opacity:.5;">/</span>
                <a href="{{ route('berita.index') }}" style="color:var(--gold-200);text-decoration:none;opacity:.75;">Berita</a>
                <span style="opacity:.5;">/</span>
                <span style="opacity:.9;">{{ Str::limit($berita->title, 60) }}</span>
            </nav>
        </div>
    </section>

    {{-- ── Article ──────────────────────────────────────────────────────── --}}
    <section class="am-section" style="background:var(--cream-50);">
        <div class="am-container" style="max-width:820px;">

            {{-- Meta --}}
            <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;margin-bottom:20px;">
                @if($berita->school)
                    <x-badge :tone="$berita->school->level === 'sdit' ? 'sdit' : 'tkit'" variant="soft" size="sm">
                        {{ $berita->school->name }}
                    </x-badge>
                @endif
                <span style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-400);display:inline-flex;align-items:center;gap:6px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    {{ $berita->published_at?->translatedFormat('d M Y') }}
                </span>
            </div>

            {{-- Title --}}
            <h1 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-4xl);line-height:1.15;letter-spacing:-0.02em;color:var(--ink-900);margin:0 0 32px;">
                {{ $berita->title }}
            </h1>

            {{-- Thumbnail --}}
            @if($berita->thumbnail_path)
                <img
                    src="{{ Storage::url($berita->thumbnail_path) }}"
                    alt="{{ $berita->title }}"
                    style="width:100%;border-radius:var(--radius-xl);margin-bottom:36px;display:block;"
                    loading="eager"
                >
            @endif

            {{-- Body --}}
            <div class="am-prose" style="font-family:var(--font-sans);font-size:var(--text-md);line-height:1.85;color:var(--ink-700);">
                {!! $berita->body !!}
            </div>
        </div>
    </section>

    {{-- ── Berita Terkait ───────────────────────────────────────────────── --}}
    @if($related->isNotEmpty())
        <section class="am-section" style="background:var(--cream-100);">
            <div class="am-container">
                <x-section-header
                    eyebrow="Lainnya"
                    title="Berita Terkait"
                    style="margin-bottom:32px;"
                />
                <div class="am-grid-3">
                    @foreach($related as $item)
                        <div class="am-reveal" style="transition-delay:{{ $loop->index * 70 }}ms;">
                            <x-news-card
                                :level="$item->school?->level === 'sdit' ? 'SDIT' : ($item->school?->level === 'tkit' ? 'TKIT' : 'Yayasan')"
                                category="Berita"
                                :date="$item->published_at?->translatedFormat('d M Y') ?? ''"
                                :title="$item->title"
                                :excerpt="Str::limit(strip_tags($item->body ?? ''), 120)"
                                :image="$item->thumbnail_path ? Storage::url($item->thumbnail_path) : null"
                                :href="route('berita.show', $item->slug)"
                            />
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</x-layouts.app>
