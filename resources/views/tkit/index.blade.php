<x-layouts.app
    navActive="tkit"
    title="Profil TKIT AL MANAR"
    :description="Str::limit(strip_tags($school->description ?? 'TK Islam Terpadu AL MANAR Kota Bekasi.'), 160)"
>

    {{-- ── Hero ─────────────────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);position:relative;overflow:hidden;padding:52px 0 44px;">
        <div style="position:absolute;inset:0;background-image:var(--pattern-girih);opacity:.35;" aria-hidden="true"></div>
        <div class="am-container" style="position:relative;">
            <div style="display:flex;align-items:center;gap:28px;flex-wrap:wrap;">
                @if($school->logo_path)
                    <img src="{{ Storage::url($school->logo_path) }}" alt="{{ $school->name }}" style="width:96px;height:96px;object-fit:contain;border-radius:var(--radius-xl);background:rgba(255,255,255,.1);padding:8px;flex-shrink:0;">
                @else
                    <div style="width:96px;height:96px;background:rgba(255,255,255,.1);border-radius:var(--radius-xl);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.7)" stroke-width="1.5"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                    </div>
                @endif
                <div style="flex:1;min-width:0;">
                    <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;margin-bottom:10px;">
                        <x-badge tone="gold" variant="solid" size="md">TKIT</x-badge>
                        @if($school->accreditation)
                            <x-badge tone="green" variant="soft" size="md">Akreditasi {{ $school->accreditation }}</x-badge>
                        @endif
                        @if($school->is_ppdb)
                            <x-badge tone="success" variant="solid" size="md">PPDB Dibuka</x-badge>
                        @endif
                    </div>
                    <h1 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-4xl);line-height:1.1;color:#FBF8F1;margin:0 0 10px;">
                        {{ $school->name }}
                    </h1>
                    <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--gold-200);margin:0;opacity:.9;">
                        TK Islam Terpadu · Kota Bekasi
                    </p>
                </div>
            </div>

            {{-- Stats strip --}}
            <div style="display:flex;gap:32px;flex-wrap:wrap;margin-top:36px;padding-top:28px;border-top:1px solid rgba(255,255,255,.15);">
                @if($school->principal_name)
                    <div>
                        <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--gold-300);margin-bottom:4px;">Kepala Sekolah</div>
                        <div style="font-family:var(--font-sans);font-size:var(--text-sm);color:#FBF8F1;">{{ $school->principal_name }}</div>
                    </div>
                @endif
                @if($school->accreditation)
                    <div>
                        <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--gold-300);margin-bottom:4px;">Akreditasi</div>
                        <div style="font-family:var(--font-display);font-size:var(--text-xl);font-weight:700;color:#FBF8F1;">{{ $school->accreditation }}</div>
                    </div>
                @endif
                <div>
                    <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--gold-300);margin-bottom:4px;">Jenjang</div>
                    <div style="font-family:var(--font-sans);font-size:var(--text-sm);color:#FBF8F1;">4–6 tahun (Kelompok A & B)</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Deskripsi ─────────────────────────────────────────────────────── --}}
    @if($school->description)
        <section class="am-section" style="background:var(--cream-50);">
            <div class="am-container" style="max-width:780px;">
                <x-section-header eyebrow="Tentang Kami" title="Mengenal TKIT AL MANAR" style="margin-bottom:24px;" />
                <div style="font-family:var(--font-sans);font-size:var(--text-md);line-height:1.8;color:var(--ink-700);">
                    {!! $school->description !!}
                </div>
            </div>
        </section>
    @endif

    {{-- ── Visi & Misi ───────────────────────────────────────────────────── --}}
    @if($school->vision || $school->mission)
        <section class="am-section" style="background:var(--surface-page);">
            <div class="am-container">
                <div class="am-grid-2" style="gap:28px;">
                    @if($school->vision)
                        <div class="am-reveal am-card" style="padding:32px;border-left:4px solid var(--green-600);">
                            <div style="display:flex;align-items:center;gap:10px;margin-bottom:20px;">
                                <div style="width:36px;height:36px;background:var(--green-100);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                                </div>
                                <h2 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-xl);color:var(--green-800);margin:0;">Visi</h2>
                            </div>
                            <div style="font-family:var(--font-sans);font-size:var(--text-md);line-height:1.75;color:var(--ink-700);">
                                {!! $school->vision !!}
                            </div>
                        </div>
                    @endif

                    @if($school->mission)
                        <div class="am-reveal am-card" style="padding:32px;border-left:4px solid var(--gold-400);">
                            <div style="display:flex;align-items:center;gap:10px;margin-bottom:20px;">
                                <div style="width:36px;height:36px;background:var(--cream-100);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--gold-600)" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                                </div>
                                <h2 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-xl);color:var(--green-800);margin:0;">Misi</h2>
                            </div>
                            <div style="font-family:var(--font-sans);font-size:var(--text-md);line-height:1.75;color:var(--ink-700);">
                                {!! $school->mission !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    {{-- ── Kontak Sekolah ─────────────────────────────────────────────── --}}
    @if($school->address || $school->phone || $school->email)
        <section class="am-section" style="background:var(--cream-100);">
            <div class="am-container">
                <x-section-header eyebrow="Informasi" title="Lokasi & Kontak" style="margin-bottom:32px;" />
                <div style="display:flex;gap:32px;flex-wrap:wrap;">
                    @if($school->address)
                        <div style="display:flex;gap:12px;align-items:flex-start;min-width:240px;">
                            <div style="width:40px;height:40px;background:var(--green-100);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--ink-400);margin-bottom:4px;">Alamat</div>
                                <div style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);line-height:1.6;">{{ $school->address }}</div>
                            </div>
                        </div>
                    @endif
                    @if($school->phone)
                        <div style="display:flex;gap:12px;align-items:flex-start;min-width:200px;">
                            <div style="width:40px;height:40px;background:var(--green-100);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.63 3.45 2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.5a16 16 0 0 0 5.59 5.59l.97-.97a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7a2 2 0 0 1 1.72 2.03z"/></svg>
                            </div>
                            <div>
                                <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--ink-400);margin-bottom:4px;">Telepon</div>
                                <a href="tel:{{ preg_replace('/\D/', '', $school->phone) }}" style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);text-decoration:none;">{{ $school->phone }}</a>
                            </div>
                        </div>
                    @endif
                    @if($school->email)
                        <div style="display:flex;gap:12px;align-items:flex-start;min-width:200px;">
                            <div style="width:40px;height:40px;background:var(--green-100);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            </div>
                            <div>
                                <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--ink-400);margin-bottom:4px;">Email</div>
                                <a href="mailto:{{ $school->email }}" style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);text-decoration:none;">{{ $school->email }}</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    {{-- ── Berita Terbaru ─────────────────────────────────────────────── --}}
    @if($latestNews->isNotEmpty())
        <section class="am-section" style="background:var(--surface-card);">
            <div class="am-container">
                <div class="am-reveal" style="display:flex;align-items:flex-end;justify-content:space-between;gap:24px;flex-wrap:wrap;margin-bottom:32px;">
                    <x-section-header eyebrow="Kabar TKIT" title="Berita Terbaru" />
                    <a href="{{ route('berita.index', ['jenjang' => 'tkit']) }}" class="am-btn am-btn--outline am-btn--sm">
                        Lihat Semua →
                    </a>
                </div>
                <div class="am-grid-3">
                    @foreach($latestNews as $news)
                        <div class="am-reveal" style="transition-delay:{{ $loop->index * 70 }}ms;">
                            <x-news-card
                                level="TKIT"
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
            </div>
        </section>
    @endif

    {{-- ── CTA ─────────────────────────────────────────────────────────── --}}
    @if($school->is_ppdb)
        <section class="am-section" style="background:var(--green-600);position:relative;overflow:hidden;">
            <div style="position:absolute;inset:0;background-image:var(--pattern-girih);opacity:.3;" aria-hidden="true"></div>
            <div class="am-container" style="position:relative;text-align:center;display:flex;flex-direction:column;align-items:center;gap:20px;">
                <x-section-header eyebrow="PPDB Dibuka" title="Daftar ke TKIT AL MANAR" tone="onbrand" align="center" />
                <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--gold-100);margin:0;max-width:480px;line-height:1.65;">
                    Pendaftaran online — mudah, cepat, dan bisa dilakukan dari mana saja.
                </p>
                <a href="{{ route('tkit.pendaftaran') }}" class="am-btn am-btn--secondary am-btn--lg">
                    Mulai Pendaftaran
                </a>
            </div>
        </section>
    @endif

</x-layouts.app>
