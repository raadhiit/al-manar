<x-layouts.app
    navActive="tkit"
    title="Profil Kelompok Bermain - Raudhatul Jannah AL MANAR"
    :description="Str::limit(strip_tags($school->description ?? 'Kelompok Bermain - Raudhatul Jannah AL MANAR Kota Bekasi.'), 160)"
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
                        Kelompok Bermain - Raudhatul Jannah · Kota Bekasi
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
                    <div style="font-family:var(--font-sans);font-size:var(--text-sm);color:#FBF8F1;">Kelompok A: 4 - 5 Tahun dan Kelompok B: 5 - 6 Tahun</div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Deskripsi ─────────────────────────────────────────────────────── --}}
    @if($school->description)
        <section class="am-section" style="background:var(--cream-50);padding-bottom:40px;">
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
        <section style="background:var(--green-800);position:relative;overflow:hidden;padding:64px 0 72px;">
            <div style="position:absolute;inset:0;background-image:var(--pattern-girih);opacity:.2;" aria-hidden="true"></div>
            <div class="am-container" style="position:relative;">

                {{-- Header --}}
                <div style="text-align:center;margin-bottom:52px;">
                    <span style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:var(--gold-300);">Identitas Sekolah</span>
                    <h2 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-3xl);color:#FBF8F1;margin:10px 0 0;">Visi &amp; Misi</h2>
                </div>

                @if($school->vision)
                {{-- Visi — full-width quote block --}}
                <div class="am-reveal" style="background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.12);border-radius:var(--radius-xl);padding:40px 48px;margin-bottom:32px;text-align:center;position:relative;">
                    <svg style="position:absolute;top:20px;left:28px;opacity:.25;" width="40" height="32" viewBox="0 0 40 32" fill="var(--gold-300)"><path d="M0 32V19.2C0 8.533 6.4 2.133 19.2 0l2.4 3.2C14.667 4.267 10.667 7.467 10 12H18V32H0zm22 0V19.2C22 8.533 28.4 2.133 41.2 0l2.4 3.2C36.667 4.267 32.667 7.467 32 12H40V32H22z"/></svg>
                    <p style="font-family:var(--font-display);font-size:clamp(1.05rem,1rem + 1vw,1.35rem);font-weight:600;font-style:italic;color:#FBF8F1;line-height:1.65;margin:0;position:relative;">
                        {{ strip_tags($school->vision) }}
                    </p>
                    <div style="display:inline-flex;align-items:center;gap:8px;margin-top:20px;">
                        <div style="height:2px;width:32px;background:var(--gold-400);border-radius:2px;"></div>
                        <span style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:var(--gold-300);">Visi</span>
                        <div style="height:2px;width:32px;background:var(--gold-400);border-radius:2px;"></div>
                    </div>
                </div>
                @endif

                @if($school->mission)
                {{-- Misi — rendered HTML dari RichEditor --}}
                <div class="am-reveal">
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;justify-content:center;">
                        <div style="height:1px;flex:1;background:rgba(255,255,255,.12);max-width:80px;"></div>
                        <span style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:var(--gold-300);">Misi</span>
                        <div style="height:1px;flex:1;background:rgba(255,255,255,.12);max-width:80px;"></div>
                    </div>
                    <div class="am-prose-onbrand" style="max-width:720px;margin:0 auto;">
                        {!! $school->mission !!}
                    </div>
                </div>
                @endif

            </div>
        </section>
    @endif

    {{-- ── Kegiatan Terbaru ──────────────────────────────────────────────── --}}
    @if($latestActivities->isNotEmpty())
        <section class="am-section" style="background:var(--cream-50);">
            <div class="am-container">
                <div class="am-reveal" style="display:flex;align-items:flex-end;justify-content:space-between;gap:24px;flex-wrap:wrap;margin-bottom:32px;">
                    <x-section-header eyebrow="Aktivitas TKIT" title="Kegiatan Terbaru" />
                    <a href="{{ route('tkit.kegiatan') }}" class="am-btn am-btn--outline am-btn--sm">
                        Lihat Semua →
                    </a>
                </div>
                <div class="am-grid-3">
                    @foreach($latestActivities as $activity)
                        @php
                            $thumb = $activity->thumbnail_path
                                ? Storage::url($activity->thumbnail_path)
                                : ($activity->youtube_id
                                    ? "https://img.youtube.com/vi/{$activity->youtube_id}/hqdefault.jpg"
                                    : ($activity->photos->first()?->path ? Storage::url($activity->photos->first()->path) : null));
                        @endphp
                        <div class="am-reveal" style="transition-delay:{{ $loop->index * 70 }}ms;">
                            <a href="{{ route('tkit.kegiatan') }}" style="text-decoration:none;display:block;">
                                <div class="am-card" style="overflow:hidden;padding:0;">
                                    <div style="position:relative;aspect-ratio:16/9;overflow:hidden;background:var(--cream-100);">
                                        @if($thumb)
                                            <img src="{{ $thumb }}" alt="{{ $activity->title }}" style="width:100%;height:100%;object-fit:cover;display:block;transition:transform .3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" loading="lazy">
                                        @else
                                            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                                                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="var(--green-300)" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                            </div>
                                        @endif
                                        @if($activity->youtube_id)
                                            <span style="position:absolute;top:12px;right:12px;background:rgba(0,0,0,.55);width:32px;height:32px;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="#fff"><path d="M8 5v14l11-7z"/></svg>
                                            </span>
                                        @endif
                                    </div>
                                    <div style="padding:16px 20px 20px;">
                                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;flex-wrap:wrap;">
                                            @if($activity->category)
                                                <x-badge tone="green" variant="soft" size="sm">{{ $activity->category }}</x-badge>
                                            @endif
                                            @if($activity->activity_date)
                                                <span style="font-family:var(--font-sans);font-size:var(--text-xs);color:var(--ink-400);">
                                                    {{ \Carbon\Carbon::parse($activity->activity_date)->translatedFormat('d M Y') }}
                                                </span>
                                            @endif
                                        </div>
                                        <h3 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-md);color:var(--ink-800);margin:0;line-height:1.4;">
                                            {{ $activity->title }}
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
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
