<x-layouts.app navActive="berita" title="Berita" description="Berita dan kabar terbaru dari Yayasan AL MANAR Kota Bekasi — SDIT dan TKIT AL MANAR.">

    {{-- ── Page header ─────────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);padding:40px 0 36px;">
        <div class="am-container">
            <x-section-header
                eyebrow="Informasi"
                title="Berita & Kabar Terbaru"
                lead="Ikuti perkembangan kegiatan dan prestasi Yayasan AL MANAR."
                tone="onbrand"
            />
        </div>
    </section>

    <section class="am-section" style="background:var(--cream-50);">
        <div class="am-container">

            {{-- Filter jenjang --}}
            @php
                $filters = ['' => 'Semua Jenjang', 'sdit' => 'SDIT AL MANAR', 'tkit' => 'TKIT AL MANAR'];
            @endphp
            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:36px;">
                @foreach($filters as $key => $label)
                    @php $isActive = $key === '' ? is_null($jenjang) : $jenjang === $key; @endphp
                    <a
                        href="{{ $key ? route('berita.index', ['jenjang' => $key]) : route('berita.index') }}"
                        class="am-btn am-btn--sm {{ $isActive ? 'am-btn--primary' : 'am-btn--outline' }}"
                    >{{ $label }}</a>
                @endforeach
            </div>

            @if($beritaList->isNotEmpty())
                <div class="am-grid-3">
                    @foreach($beritaList as $news)
                        <div class="am-reveal" style="transition-delay:{{ ($loop->index % 3) * 70 }}ms;">
                            <x-news-card
                                :level="$news->school?->level === 'sdit' ? 'SDIT' : ($news->school?->level === 'tkit' ? 'TKIT' : 'Yayasan')"
                                category="Berita"
                                :date="$news->published_at?->translatedFormat('d M Y') ?? ''"
                                :title="$news->title"
                                :excerpt="Str::limit(strip_tags($news->body ?? ''), 120)"
                                :image="$news->thumbnail_path ? Storage::url($news->thumbnail_path) : null"
                                :href="route('berita.show', $news->slug)"
                            />
                        </div>
                    @endforeach
                </div>

                <div style="margin-top:48px;">
                    {{ $beritaList->links() }}
                </div>
            @else
                <div style="text-align:center;padding:80px 20px;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--green-300)" stroke-width="1.5" style="display:block;margin:0 auto 16px;"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6h8v4h-8z"/></svg>
                    <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--ink-400);margin:0;">
                        Belum ada berita yang dipublikasikan
                        @if($jenjang) untuk jenjang ini @endif.
                    </p>
                    @if($jenjang)
                        <a href="{{ route('berita.index') }}" class="am-btn am-btn--outline am-btn--sm" style="margin-top:16px;display:inline-flex;">
                            Lihat semua berita
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </section>

</x-layouts.app>
