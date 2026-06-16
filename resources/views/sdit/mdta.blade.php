<x-layouts.app navActive="sdit" title="Program MDTA" description="Profil Madrasah Diniyah Takmiliyah Awaliyah (MDTA) AL MANAR — pendalaman Al-Qur'an, akidah, fikih, dan akhlak bagi santri SDIT AL MANAR.">

    {{-- ── Page header ─────────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);padding:40px 0 36px;">
        <div class="am-container">
            <nav style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--gold-200);display:flex;align-items:center;gap:8px;margin-bottom:20px;opacity:.8;">
                <a href="{{ route('home') }}" style="color:inherit;text-decoration:none;">Beranda</a>
                <span>/</span>
                <a href="{{ route('sdit.index') }}" style="color:inherit;text-decoration:none;">SDIT AL MANAR</a>
                <span>/</span>
                <span>MDTA</span>
            </nav>
            <x-section-header
                eyebrow="Program Diniyah SDIT AL MANAR"
                title="Madrasah Diniyah Takmiliyah Awaliyah (MDTA)"
                lead="Pendalaman pendidikan agama Islam sebagai pelengkap (takmili) pembelajaran formal di SDIT AL MANAR — berlangsung siang hari setelah KBM pagi."
                tone="onbrand"
            />
        </div>
    </section>

    {{-- ── Tentang MDTA ────────────────────────────────────────────────── --}}
    <section class="am-section" style="background:var(--cream-50);">
        <div class="am-container">
            <div class="am-grid-2" style="gap:32px;align-items:start;">
                <div class="am-reveal">
                    <x-badge tone="gold" variant="soft" size="sm" style="margin-bottom:14px;">Tentang MDTA</x-badge>
                    <h2 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-2xl);color:var(--green-800);margin:0 0 16px;">
                        Pelengkap pendidikan agama di luar jam sekolah formal
                    </h2>
                    <p style="font-family:var(--font-sans);font-size:var(--text-md);line-height:1.8;color:var(--ink-700);margin:0;">
                        MDTA hadir sebagai lembaga pendidikan keagamaan Islam nonformal yang strategis di Bekasi Utara, Kota Bekasi. MDTA memberikan penguatan pendidikan agama Islam bagi anak-anak usia sekolah dasar (SD/MI) — biasanya berlangsung di siang hari — sebagai pelengkap dari pendidikan formal yang mereka terima di SDIT AL MANAR. Melalui MDTA, santri dibekali kemampuan dasar membaca Al-Qur'an, pemahaman akidah, ibadah praktis, serta pembiasaan akhlakul karimah sejak dini.
                    </p>
                </div>

                <div class="am-reveal" style="transition-delay:80ms;background:var(--surface-card);border:1px solid var(--border-default);border-radius:var(--radius-xl);padding:28px;box-shadow:var(--shadow-sm);">
                    <h3 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-md);color:var(--green-800);margin:0 0 6px;">Visi</h3>
                    <p style="font-family:var(--font-sans);font-size:var(--text-sm);line-height:1.7;color:var(--ink-600);margin:0 0 20px;font-style:italic;">
                        "Terwujudnya santri cerdas, kreatif, inovatif, dan berakhlakul mulia."
                    </p>

                    <h3 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-md);color:var(--green-800);margin:0 0 10px;">Misi</h3>
                    <ul style="list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:10px;">
                        @foreach([
                            'Menyelenggarakan pembelajaran Al-Qur\'an, Hadits, Fikih, Aqidah Akhlak, Sejarah Kebudayaan Islam (SKI), dan Bahasa Arab.',
                            'Membentuk pribadi disiplin dan berdedikasi tinggi, berpikir logis dan kritis sesuai nilai-nilai Islam.',
                            'Turut menyukseskan program pemerintah dalam mencerdaskan kehidupan bangsa berdasarkan keimanan kepada Tuhan Yang Maha Esa.',
                        ] as $misi)
                            <li style="display:flex;gap:10px;align-items:flex-start;font-family:var(--font-sans);font-size:var(--text-sm);line-height:1.6;color:var(--ink-700);">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--gold-500)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" style="flex:none;margin-top:3px;"><polyline points="20 6 9 17 4 12"/></svg>
                                {{ $misi }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Mata Pelajaran Pokok ───────────────────────────────────────── --}}
    <section class="am-section" style="background:var(--surface-card);">
        <div class="am-container">
            <div class="am-reveal" style="margin-bottom:36px;">
                <x-section-header
                    eyebrow="Kurikulum & Materi"
                    title="Mata pelajaran pokok MDTA"
                    lead="Mengacu pada standar Kementerian Agama RI, diikuti santri usia 7–12 tahun selama 2–4 tahun."
                />
            </div>
            <div class="am-grid-3">
                @foreach([
                    ['title' => 'Al-Qur\'an Hadits', 'desc' => 'Membaca, menghafal surat-surat pendek (Juz Amma), tajwid dasar, dan hadits-hadits pendek tentang akhlak.'],
                    ['title' => 'Aqidah Akhlak', 'desc' => 'Penanaman rukun iman, sifat-sifat Allah, serta adab sehari-hari kepada orang tua, guru, dan teman.'],
                    ['title' => 'Fikih', 'desc' => 'Tata cara thaharah (bersuci), wudhu, shalat fardhu, shalat sunnah, dan puasa.'],
                    ['title' => 'Tarikh / SKI', 'desc' => 'Kisah Nabi Muhammad SAW, para Sahabat, dan perkembangan Islam secara sederhana.'],
                    ['title' => 'Bahasa Arab', 'desc' => 'Pengenalan kosakata dasar (mufradat) dan percakapan harian sederhana.'],
                    ['title' => 'Praktik Ibadah & Muatan Lokal', 'desc' => 'Kaligrafi (Khat), doa-doa harian, dan hafalan bacaan shalat.'],
                ] as $mapel)
                    <div class="am-reveal" style="background:var(--cream-50);border:1px solid var(--border-subtle);border-radius:var(--radius-lg);padding:24px;">
                        <div style="width:40px;height:40px;background:var(--gold-100);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;margin-bottom:14px;">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--gold-600)" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                        </div>
                        <h3 style="font-family:var(--font-sans);font-weight:700;font-size:var(--text-md);color:var(--ink-900);margin:0 0 6px;">{{ $mapel['title'] }}</h3>
                        <p style="font-family:var(--font-sans);font-size:var(--text-sm);line-height:1.65;color:var(--ink-600);margin:0;">{{ $mapel['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Keadaan Kelembagaan ────────────────────────────────────────── --}}
    <section class="am-section" style="background:var(--green-800);position:relative;overflow:hidden;">
        <div style="position:absolute;inset:0;background-image:var(--pattern-girih);opacity:.4;" aria-hidden="true"></div>
        <div class="am-container" style="position:relative;">
            <div class="am-reveal" style="margin-bottom:36px;">
                <x-section-header
                    eyebrow="Potensi & Realita"
                    title="Keadaan kelembagaan MDTA AL MANAR"
                    tone="onbrand"
                />
            </div>
            <div class="am-grid-2" style="gap:20px;">
                @foreach([
                    ['title' => 'Sumber Daya Manusia (Guru/Ustadz)', 'desc' => 'Terdiri dari alumni pondok pesantren dan sarjana pendidikan Islam yang berdedikasi tinggi mengajar secara part-time.'],
                    ['title' => 'Sarana & Prasarana', 'desc' => 'Terintegrasi dengan fasilitas Masjid, gedung Yayasan, atau memanfaatkan ruang kelas SDIT AL MANAR pada siang hari.'],
                    ['title' => 'Waktu Belajar', 'desc' => 'Dilaksanakan pukul 13.00–15.20 WIB, setelah santri menyelesaikan KBM SD pada pagi hari.'],
                    ['title' => 'Koordinasi Lembaga', 'desc' => 'Berada di bawah binaan Seksi PD Pontren Kantor Kementerian Agama Kota Bekasi, didukung FKDT Kota Bekasi.'],
                ] as $item)
                    <div class="am-reveal" style="background:rgba(251,248,241,0.06);border:1px solid rgba(217,171,61,0.25);border-radius:var(--radius-lg);padding:22px 24px;">
                        <h3 style="font-family:var(--font-sans);font-weight:700;font-size:var(--text-sm);color:var(--gold-200);margin:0 0 8px;">{{ $item['title'] }}</h3>
                        <p style="font-family:var(--font-sans);font-size:var(--text-sm);line-height:1.7;color:rgba(251,248,241,.85);margin:0;">{{ $item['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Dasar Hukum ─────────────────────────────────────────────────── --}}
    <section class="am-section" style="background:var(--cream-100);">
        <div class="am-container">
            <div class="am-reveal" style="margin-bottom:28px;">
                <x-section-header eyebrow="Legalitas" title="Dasar hukum penyelenggaraan MDTA" />
            </div>
            <ul class="am-reveal" style="list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:12px;max-width:760px;">
                @foreach([
                    'Undang-Undang No. 20 Tahun 2003 tentang Sistem Pendidikan Nasional.',
                    'Peraturan Pemerintah No. 55 Tahun 2007 tentang Pendidikan Agama dan Pendidikan Keagamaan.',
                    'Peraturan Menteri Agama (PMA) No. 13 Tahun 2014 tentang Pendidikan Keagamaan Islam.',
                    'Kebijakan/Peraturan Daerah Kota Bekasi terkait fasilitasi pendalaman karakter keagamaan siswa sekolah dasar.',
                ] as $dasar)
                    <li style="display:flex;gap:12px;align-items:flex-start;font-family:var(--font-sans);font-size:var(--text-sm);line-height:1.65;color:var(--ink-700);background:var(--surface-card);border:1px solid var(--border-subtle);border-radius:var(--radius-md);padding:14px 18px;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" style="flex:none;margin-top:2px;"><polyline points="20 6 9 17 4 12"/></svg>
                        {{ $dasar }}
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    {{-- ── CTA ─────────────────────────────────────────────────────────── --}}
    <section class="am-section" style="background:var(--surface-page);">
        <div class="am-container" style="text-align:center;display:flex;flex-direction:column;align-items:center;gap:16px;">
            <x-section-header eyebrow="Informasi Lebih Lanjut" title="Ingin tahu lebih jauh tentang program MDTA?" align="center" />
            <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--ink-500);margin:0;max-width:480px;line-height:1.65;">
                Program MDTA otomatis diikuti oleh seluruh santri SDIT AL MANAR sebagai bagian dari pembelajaran terpadu sehari-hari.
            </p>
            <div style="display:flex;gap:14px;flex-wrap:wrap;justify-content:center;margin-top:8px;">
                <a href="{{ route('sdit.pendaftaran') }}" class="am-btn am-btn--primary am-btn--lg">Daftar SDIT AL MANAR</a>
                <a href="{{ route('kontak') }}" class="am-btn am-btn--outline am-btn--lg">Hubungi Kami</a>
            </div>
        </div>
    </section>

</x-layouts.app>
