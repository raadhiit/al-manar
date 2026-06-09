<x-layouts.app navActive="portal" title="Informasi Kurikulum" description="Informasi kurikulum SDIT dan TKIT AL MANAR — Kurikulum Merdeka dan Standar PAUD Nasional.">

    {{-- ── Page header ─────────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);padding:40px 0 36px;">
        <div class="am-container">
            <nav style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--gold-200);display:flex;align-items:center;gap:8px;margin-bottom:20px;opacity:.8;">
                <a href="{{ route('home') }}" style="color:inherit;text-decoration:none;">Beranda</a>
                <span>/</span>
                <span>Portal Akademik</span>
                <span>/</span>
                <span>Kurikulum</span>
            </nav>
            <x-section-header
                eyebrow="Portal Akademik"
                title="Informasi Kurikulum"
                lead="Pendekatan pembelajaran yang kami terapkan di SDIT dan TKIT AL MANAR."
                tone="onbrand"
            />
            {{-- Sub-nav portal --}}
            <div style="display:flex;gap:8px;flex-wrap:wrap;margin-top:28px;">
                <a href="{{ route('portal.kalender') }}" class="am-btn am-btn--onbrand am-btn--sm">Kalender</a>
                <a href="{{ route('portal.kurikulum') }}" class="am-btn am-btn--secondary am-btn--sm">Kurikulum</a>
                <a href="{{ route('portal.pengumuman') }}" class="am-btn am-btn--onbrand am-btn--sm">Pengumuman</a>
                <a href="{{ route('portal.download') }}" class="am-btn am-btn--onbrand am-btn--sm">Download</a>
            </div>
        </div>
    </section>

    {{-- ── Kurikulum SDIT & TKIT ─────────────────────────────────────── --}}
    <section class="am-section" style="background:var(--cream-50);">
        <div class="am-container">
            <div class="am-grid-2" style="gap:32px;align-items:start;">

                {{-- Kurikulum Merdeka (SDIT) --}}
                <div class="am-reveal">
                    <div style="display:inline-flex;align-items:center;gap:10px;margin-bottom:24px;">
                        <div style="width:48px;height:48px;background:var(--green-600);border-radius:var(--radius-lg);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                        </div>
                        <div>
                            <x-badge tone="sdit" variant="soft" size="sm" style="margin-bottom:4px;">SDIT</x-badge>
                            <h2 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-2xl);color:var(--green-800);margin:0;">
                                Kurikulum Merdeka
                            </h2>
                        </div>
                    </div>

                    <p style="font-family:var(--font-sans);font-size:var(--text-md);line-height:1.8;color:var(--ink-700);margin:0 0 20px;">
                        SDIT AL MANAR mengimplementasikan <strong>Kurikulum Merdeka</strong> sesuai kebijakan Kemendikbudristek. Kurikulum ini berfokus pada penguatan karakter, kompetensi esensial, dan pembelajaran yang relevan bagi peserta didik.
                    </p>

                    <div style="display:flex;flex-direction:column;gap:14px;">
                        @foreach([
                            ['title' => 'Profil Pelajar Pancasila', 'desc' => 'Beriman, mandiri, bernalar kritis, kreatif, bergotong-royong, dan berkebinekaan global.'],
                            ['title' => 'Pembelajaran Berpusat pada Siswa', 'desc' => 'Guru sebagai fasilitator; siswa aktif mengeksplorasi, berkolaborasi, dan merefleksikan pembelajaran.'],
                            ['title' => 'Projek P5', 'desc' => 'Kegiatan berbasis projek lintas mata pelajaran yang dikaitkan dengan tema nyata di lingkungan sekolah.'],
                            ['title' => 'Program Tahfizh Terintegrasi', 'desc' => 'Target hafalan Al-Qur\'an 3 juz selama jenjang SD, diintegrasikan dalam jadwal harian.'],
                        ] as $item)
                            <div style="display:flex;gap:14px;align-items:flex-start;">
                                <div style="width:34px;height:34px;background:var(--green-100);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                </div>
                                <div>
                                    <div style="font-family:var(--font-sans);font-weight:700;font-size:var(--text-sm);color:var(--ink-900);margin-bottom:3px;">{{ $item['title'] }}</div>
                                    <div style="font-family:var(--font-sans);font-size:var(--text-sm);line-height:1.65;color:var(--ink-600);">{{ $item['desc'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Kurikulum TKIT --}}
                <div class="am-reveal" style="transition-delay:80ms;">
                    <div style="display:inline-flex;align-items:center;gap:10px;margin-bottom:24px;">
                        <div style="width:48px;height:48px;background:var(--gold-400);border-radius:var(--radius-lg);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <div>
                            <x-badge tone="tkit" variant="soft" size="sm" style="margin-bottom:4px;">TKIT</x-badge>
                            <h2 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-2xl);color:var(--green-800);margin:0;">
                                Standar PAUD Nasional
                            </h2>
                        </div>
                    </div>

                    <p style="font-family:var(--font-sans);font-size:var(--text-md);line-height:1.8;color:var(--ink-700);margin:0 0 20px;">
                        TKIT AL MANAR mengacu pada <strong>Standar PAUD Nasional</strong> (Permendikbud 137/2014) yang diintegrasikan dengan nilai-nilai Islam terpadu — membentuk fondasi karakter dan kecerdasan anak usia 4–6 tahun.
                    </p>

                    <div style="display:flex;flex-direction:column;gap:14px;">
                        @foreach([
                            ['title' => 'Pendekatan Sentra', 'desc' => 'Sentra bermain terstruktur: bahan alam, seni, persiapan, ibadah, dan balok untuk stimulasi optimal.'],
                            ['title' => 'Pembiasaan Islami Harian', 'desc' => 'Hafalan doa & hadits pendek, sholat berjamaah, adab harian, dan cinta Al-Qur\'an sejak usia dini.'],
                            ['title' => '6 Aspek Perkembangan', 'desc' => 'Nilai agama & moral, kognitif, bahasa, fisik-motorik, sosial-emosional, dan seni — terukur dan terpantau.'],
                            ['title' => 'Rasio Guru–Murid Ideal', 'desc' => 'Perhatian personal maksimal dengan rasio guru-murid yang terjaga untuk tumbuh kembang optimal.'],
                        ] as $item)
                            <div style="display:flex;gap:14px;align-items:flex-start;">
                                <div style="width:34px;height:34px;background:var(--cream-100);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="var(--gold-600)" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                </div>
                                <div>
                                    <div style="font-family:var(--font-sans);font-weight:700;font-size:var(--text-sm);color:var(--ink-900);margin-bottom:3px;">{{ $item['title'] }}</div>
                                    <div style="font-family:var(--font-sans);font-size:var(--text-sm);line-height:1.65;color:var(--ink-600);">{{ $item['desc'] }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── Keunggulan Terpadu ─────────────────────────────────────────── --}}
    <section class="am-section" style="background:var(--green-800);position:relative;overflow:hidden;">
        <div style="position:absolute;inset:0;background-image:var(--pattern-girih);opacity:.4;" aria-hidden="true"></div>
        <div class="am-container" style="position:relative;">
            <div class="am-reveal" style="margin-bottom:40px;">
                <x-section-header
                    eyebrow="Ciri Khas AL MANAR"
                    title="Kurikulum Nasional + Islam Terpadu"
                    tone="onbrand"
                    align="center"
                />
            </div>
            <div class="am-grid-4">
                @foreach([
                    ['v' => 'Tahfizh', 'l' => 'Target 3 Juz',       's' => 'Jenjang SDIT'],
                    ['v' => 'Adab',    'l' => 'Karakter Islami',     's' => 'Setiap hari'],
                    ['v' => 'Bilingual','l' => 'Arab & Inggris',     's' => 'Terintegrasi'],
                    ['v' => 'Merdeka', 'l' => 'Kurikulum Nasional',  's' => 'Standar Kemendikbud'],
                ] as $s)
                    <div class="am-reveal" style="transition-delay:{{ $loop->index * 70 }}ms;">
                        <div style="background:rgba(251,248,241,0.06);border:1px solid rgba(217,171,61,0.25);border-radius:var(--radius-lg);padding:24px 20px;text-align:center;">
                            <x-stat :value="$s['v']" :label="$s['l']" :sublabel="$s['s']" tone="onbrand" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── CTA ─────────────────────────────────────────────────────────── --}}
    <section class="am-section" style="background:var(--cream-100);">
        <div class="am-container" style="text-align:center;display:flex;flex-direction:column;align-items:center;gap:16px;">
            <x-section-header eyebrow="Unduh Dokumen" title="Butuh silabus atau modul pembelajaran?" align="center" />
            <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--ink-500);margin:0;max-width:480px;line-height:1.65;">
                Dokumen kurikulum, silabus, dan panduan pembelajaran tersedia di Download Area.
            </p>
            <div style="display:flex;gap:14px;flex-wrap:wrap;justify-content:center;margin-top:8px;">
                <a href="{{ route('portal.download') }}" class="am-btn am-btn--primary am-btn--lg">Buka Download Area</a>
                <a href="{{ route('kontak') }}" class="am-btn am-btn--outline am-btn--lg">Hubungi Kami</a>
            </div>
        </div>
    </section>

</x-layouts.app>
