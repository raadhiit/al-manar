<x-layouts.app navActive="home" title="Beranda" description="Yayasan Al Muhajirin AL MANAR Kota Bekasi — Pendidikan Islam terpadu SDIT & TKIT yang membentuk generasi Qur'ani, berakhlak mulia, dan berprestasi.">

    {{-- ── Hero Slider ─────────────────────────────────────────────────── --}}
    @php $slideCount = $heroSlides->count(); @endphp
    <section
        x-data="{
            current: 0,
            total: {{ $slideCount }},
            init() {
                if (this.total > 1) {
                    setInterval(() => { this.current = (this.current + 1) % this.total; }, 5500);
                }
            }
        }"
        style="position:relative;min-height:580px;overflow:hidden;background:var(--green-900);"
    >
        {{-- Slides --}}
        @forelse($heroSlides as $slide)
        <div
            x-show="current === {{ $loop->index }}"
            x-transition:enter="hero-fade-enter"
            x-transition:enter-start="hero-fade-enter-start"
            x-transition:enter-end="hero-fade-enter-end"
            x-transition:leave="hero-fade-leave"
            x-transition:leave-start="hero-fade-leave-start"
            x-transition:leave-end="hero-fade-leave-end"
            style="position:absolute;inset:0;"
        >
            <img
                src="{{ Storage::url($slide['path']) }}"
                alt="Foto {{ $slide['school'] }} AL MANAR"
                style="width:100%;height:100%;object-fit:cover;display:block;"
                loading="{{ $loop->first ? 'eager' : 'lazy' }}"
            >
            <div style="position:absolute;inset:0;background:linear-gradient(to bottom, rgba(0,0,0,.45) 0%, rgba(0,0,0,.72) 100%);"></div>
        </div>
        @empty
        {{-- Fallback: no activity photos yet --}}
        <div style="position:absolute;inset:0;">
            <div style="position:absolute;inset:0;background-image:var(--pattern-girih);opacity:.15;"></div>
        </div>
        @endforelse

        {{-- Text overlay --}}
        <div style="position:relative;z-index:10;display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:580px;padding:80px 24px 100px;text-align:center;">
            <div style="max-width:760px;">
                @if($sdit?->is_ppdb)
                <div style="margin-bottom:16px;">
                    <x-badge tone="gold" variant="solid" size="md" style="color:#fff;">PPDB {{ date('Y') }} Dibuka</x-badge>
                </div>
                @endif

                <span style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:var(--gold-300);display:block;margin-bottom:14px;">Yayasan Al Muhajirin AL MANAR · Kota Bekasi</span>

                <h1 style="font-family:var(--font-display);font-weight:700;font-size:clamp(2rem,4vw,3.2rem);line-height:1.1;color:#FBF8F1;margin:0 0 20px;text-shadow:0 2px 12px rgba(0,0,0,.3);">
                    Menumbuhkan generasi <span style="color:var(--gold-400);">Qur'ani</span><br>yang berakhlak &amp; berprestasi
                </h1>

                <p style="font-family:var(--font-sans);font-size:var(--text-md);line-height:1.7;color:rgba(251,248,241,.85);margin:0 0 32px;max-width:580px;margin-left:auto;margin-right:auto;">
                    Pendidikan Islam terpadu dari Kelompok Bermain hingga sekolah dasar — memadukan kurikulum nasional, pembinaan akhlak, dan tahfizh Al-Qur'an.
                </p>

                <div style="display:flex;gap:14px;flex-wrap:wrap;justify-content:center;">
                    <a href="{{ route('sdit.pendaftaran') }}" class="am-btn am-btn--primary am-btn--lg">Daftar Sekarang</a>
                    <a href="{{ route('sdit.index') }}" class="am-btn am-btn--glass am-btn--lg">Profil Sekolah</a>
                </div>
            </div>
        </div>

        {{-- Dot indicators --}}
        @if($slideCount > 1)
        <div style="position:absolute;bottom:28px;left:50%;transform:translateX(-50%);z-index:10;display:flex;gap:8px;align-items:center;">
            @foreach($heroSlides as $slide)
            <button
                type="button"
                @click="current = {{ $loop->index }}"
                :style="current === {{ $loop->index }} ? 'width:24px;opacity:1;background:#fff;' : 'width:8px;opacity:.5;background:#fff;'"
                style="height:8px;border-radius:4px;border:none;cursor:pointer;padding:0;transition:all .35s ease;"
                aria-label="Slide {{ $loop->iteration }}"
            ></button>
            @endforeach
        </div>
        @endif
    </section>

    {{-- Stats strip --}}
    {{-- <div style="background:var(--surface-card);border-bottom:1px solid var(--border-subtle);">
        <div class="am-container">
            <div style="display:flex;gap:36px;padding-top:22px;padding-bottom:28px;flex-wrap:wrap;justify-content:space-between;">
                <x-stat value="A" label="Akreditasi" sublabel="SDIT & TKIT" tone="gold" />
                <x-stat value="1.200+" label="Alumni" sublabel="Sejak 2009" />
                <x-stat value="40+" label="Tenaga Pendidik" sublabel="Tersertifikasi" />
            </div>
        </div>
    </div> --}}

    {{-- ── Achievements band ──────────────────────────────────────────────── --}}
    {{-- <section class="am-section" style="background:var(--green-800);position:relative;overflow:hidden;">
        <div style="position:absolute;inset:0;background-image:var(--pattern-girih);opacity:.5;" aria-hidden="true"></div>
        <div class="am-container" style="position:relative;">
            <div class="am-reveal">
                <x-section-header
                    eyebrow="Prestasi & Capaian"
                    title="Hasil yang membanggakan, akhlak yang utama"
                    tone="onbrand"
                    align="center"
                    style="justify-content:center;margin-bottom:40px;"
                />
            </div>

            <div class="am-grid-4">
                @foreach([
                    ['value' => '32',    'label' => 'Prestasi diraih',    'sub' => '2 tahun terakhir'],
                    ['value' => '95%',   'label' => 'Lulusan diterima',   'sub' => 'SMP/MTs favorit'],
                    ['value' => '3 Juz', 'label' => 'Target tahfizh',     'sub' => 'Jenjang SDIT'],
                    ['value' => '18',    'label' => 'Ekstrakurikuler',    'sub' => 'Akademik & non-akademik'],
                ] as $stat)
                    <div class="am-reveal" style="transition-delay:{{ $loop->index * 70 }}ms;">
                        <div style="background:rgba(251,248,241,0.06);border:1px solid rgba(217,171,61,0.25);border-radius:var(--radius-lg);padding:24px 22px;">
                            <x-stat :value="$stat['value']" :label="$stat['label']" :sublabel="$stat['sub']" tone="onbrand" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section> --}}

    {{-- ── Schools & MDTA ────────────────────────────────────────────────── --}}
    <section class="am-section" style="background:var(--surface-page);padding-bottom:calc(var(--section-y) / 2);">
        <div class="am-container">
            <div class="am-reveal">
                <x-section-header
                    eyebrow="Unit Pendidikan & Program"
                    title="Satu yayasan, jenjang pendidikan terpadu"
                    lead="Pendidikan Islam yang berkesinambungan — dari usia dini hingga sekolah dasar, dilengkapi pendalaman Al-Qur'an."
                    style="margin-bottom:36px;"
                />
            </div>

            <div class="am-grid-3 am-mobile-slider">
                <div class="am-reveal">
                    <x-school-card
                        level="SDIT"
                        name="SDIT AL MANAR"
                        tagline="Sekolah Dasar Islam Terpadu"
                        description="Kurikulum nasional terintegrasi nilai Islam, program tahfizh, dan pembinaan karakter yang kuat."
                        ageRange="7–12 tahun"
                        accreditation="{{ $sdit?->accreditation ?? 'A' }}"
                        :image="$sdit?->thumbnail_path ? Storage::url($sdit->thumbnail_path) : ($sdit?->logo_path ? Storage::url($sdit->logo_path) : null)"
                        :points="['Target hafalan hingga 3 juz', 'Pembelajaran bilingual & literasi digital', 'Ekstrakurikuler lengkap & pramuka SIT']"
                        :href="route('sdit.index')"
                    />
                </div>

                <div class="am-reveal" style="transition-delay:80ms;">
                    <article style="display:flex;flex-direction:column;height:100%;background:var(--surface-card);border:1px solid var(--border-default);border-radius:var(--radius-xl);overflow:hidden;box-shadow:var(--shadow-sm);">
                        <div style="position:relative;background:var(--green-700);min-height:210px;display:flex;align-items:center;justify-content:center;overflow:hidden;">
                            <div style="position:absolute;inset:0;background-image:var(--pattern-girih);opacity:.3;" aria-hidden="true"></div>
                            <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="var(--gold-300)" stroke-width="1.4" style="position:relative;"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                            <span style="position:absolute;top:16px;left:16px;">
                                <x-badge tone="gold" variant="solid" size="md">MDTA</x-badge>
                            </span>
                        </div>
                        <div style="padding:26px 26px 28px;display:flex;flex-direction:column;gap:14px;flex:1;">
                            <div style="display:flex;flex-direction:column;gap:4px;">
                                <span style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:var(--ink-400);">
                                    Program SDIT AL MANAR
                                </span>
                                <h3 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-2xl);color:var(--ink-900);margin:0;text-wrap:balance;">
                                    Madrasah Diniyah Takmiliyah Awaliyah
                                </h3>
                            </div>
                            <p style="font-family:var(--font-sans);font-size:var(--text-sm);line-height:1.65;color:var(--ink-500);margin:0;flex:1;">
                                Pendalaman Al-Qur'an, akidah, fikih, dan akhlak bagi santri SDIT AL MANAR — berlangsung siang hari sebagai pelengkap pembelajaran formal, mengacu pada standar Kementerian Agama RI.
                            </p>
                            <div style="margin-top:8px;padding-top:18px;border-top:1px solid var(--border-subtle);">
                                <a href="{{ route('sdit.mdta') }}" class="am-btn am-btn--secondary am-btn--sm">
                                    Pelajari Program MDTA
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="am-reveal" style="transition-delay:160ms;">
                    <x-school-card
                        level="KB"
                        name="KB-RA"
                        tagline="Kelompok Bermain - Raudhatul Jannah"
                        description="Belajar sambil bermain dengan pembiasaan ibadah, adab, dan stimulasi tumbuh kembang yang menyenangkan."
                        ageRange="4–6 tahun"
                        accreditation="{{ $tkit?->accreditation ?? 'A' }}"
                        :image="$tkit?->thumbnail_path ? Storage::url($tkit->thumbnail_path) : ($tkit?->logo_path ? Storage::url($tkit->logo_path) : null)"
                        :points="['Sentra bermain edukatif', 'Pembiasaan sholat, doa & hadits', 'Rasio guru–murid ideal']"
                        :href="route('tkit.index')"
                    />
                </div>
            </div>
        </div>
    </section>

    {{-- ── Program SDIT ──────────────────────────────────────────────────── --}}
    <section class="am-section" style="background:var(--green-800);padding-top:calc(var(--section-y) / 6);padding-bottom:calc(var(--section-y) / 2);">
        <div class="am-container">
            <div class="am-reveal">
                <x-section-header
                    eyebrow="Program Unggulan"
                    title="Program SDIT AL MANAR"
                    lead="Kegiatan rutin yang membentuk karakter, kemampuan bahasa, dan bakat siswa."
                    tone="onbrand"
                    align="center"
                    style="justify-content:center;margin-bottom:36px;"
                />
            </div>

            <div class="am-grid-4 am-program-grid">
                @foreach([
                    [
                        'tone'  => 'green',
                        'title' => 'MABIT',
                        'desc'  => 'Malam Bina Iman dan Takwa',
                        'icon'  => '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>',
                    ],
                    [
                        'tone'  => 'gold',
                        'title' => 'Munaqosah',
                        'desc'  => 'Ujian tahfizh & kelayakan hafalan',
                        'icon'  => '<path d="M12 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/><path d="M8.5 13.5 6 21l6-3 6 3-2.5-7.5"/>',
                    ],
                    [
                        'tone'  => 'green',
                        'title' => 'Language Day',
                        'desc'  => 'Pembiasaan bilingual & percakapan aktif',
                        'icon'  => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/>',
                    ],
                    [
                        'tone'  => 'gold',
                        'title' => 'Talent Day',
                        'desc'  => 'Unjuk bakat akademik & non-akademik',
                        'icon'  => '<path d="M8 21h8M12 17v4M7 4h10v5a5 5 0 0 1-10 0z"/><path d="M5 6H3v2a4 4 0 0 0 4 4M19 6h2v2a4 4 0 0 1-4 4"/>',
                    ],
                ] as $program)
                    <div class="am-reveal" style="transition-delay:{{ $loop->index * 70 }}ms;">
                        <div style="background:var(--surface-card);border:1px solid var(--border-default);border-radius:var(--radius-xl);box-shadow:var(--shadow-sm);padding:30px 24px;display:flex;flex-direction:column;align-items:center;text-align:center;gap:14px;height:100%;transition:box-shadow .2s,transform .2s;" class="am-program-card">
                            <div style="width:64px;height:64px;border-radius:50%;display:flex;align-items:center;justify-content:center;background:{{ $program['tone'] === 'gold' ? 'var(--gold-100)' : 'var(--green-100)' }};">
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="{{ $program['tone'] === 'gold' ? 'var(--gold-600)' : 'var(--green-600)' }}" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">{!! $program['icon'] !!}</svg>
                            </div>
                            <div style="display:flex;flex-direction:column;gap:6px;">
                                <h3 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-lg);color:var(--ink-900);margin:0;">
                                    {{ $program['title'] }}
                                </h3>
                                <p style="font-family:var(--font-sans);font-size:var(--text-sm);line-height:1.55;color:var(--ink-500);margin:0;">
                                    {{ $program['desc'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── Kepala Sekolah ────────────────────────────────────────────────── --}}
    @if($sditPrincipal || $tkitPrincipal)
    <section class="am-section" style="background:var(--surface-card);padding-top:calc(var(--section-y) / 2);">
        <div class="am-container">
            <div class="am-reveal">
                <x-section-header
                    eyebrow="Kepala Sekolah"
                    title="Mengenal sosok di balik kepemimpinan AL MANAR"
                    align="center"
                    style="justify-content:center;margin-bottom:28px;"
                />
            </div>
        </div>
        <div class="am-container" style="display:flex;flex-direction:column;gap:20px;">
            @if($sditPrincipal)
                <div class="am-reveal" style="background:var(--surface-card);border:1px solid var(--border-default);border-radius:var(--radius-xl);box-shadow:var(--shadow-sm);overflow:hidden;display:flex;flex-wrap:wrap;align-items:stretch;">
                    <div class="am-principal-photo" style="overflow:hidden;background:var(--green-100);">
                        @if($sditPrincipal->photo_path)
                            <img src="{{ Storage::url($sditPrincipal->photo_path) }}" alt="{{ $sditPrincipal->name }}" class="am-principal-img" style="width:100%;height:100%;object-fit:cover;object-position:top center;display:block;">
                        @else
                            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                                <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="var(--green-400)" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="am-principal-body" style="flex:1 1 280px;padding:32px 36px;display:flex;flex-direction:column;justify-content:center;align-items:flex-start;">
                        <x-badge tone="gold" variant="soft" size="sm" style="margin-bottom:14px;">Kepala Sekolah · SDIT AL MANAR</x-badge>
                        <h2 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-2xl);color:var(--green-800);margin:0 0 6px;">
                            {{ $sditPrincipal->name }}
                        </h2>
                        <span style="font-family:var(--font-sans);font-size:var(--text-sm);font-weight:600;color:var(--ink-500);display:block;margin-bottom:12px;">{{ $sditPrincipal->position }}</span>
                        @if($sditPrincipal->bio)
                            <p style="font-family:var(--font-sans);font-size:var(--text-md);line-height:1.75;color:var(--ink-600);margin:0;max-width:560px;">
                                {{ $sditPrincipal->bio }}
                            </p>
                        @endif
                    </div>
                    @if(!empty($sditPrincipal->education) || $sditPrincipal->leadership_vision)
                        <div class="am-principal-extra" style="flex:1 1 280px;display:flex;flex-direction:column;">
                            @if(!empty($sditPrincipal->education))
                                <div style="flex:1;padding:24px 28px;{{ $sditPrincipal->leadership_vision ? 'border-bottom:1px solid var(--border-subtle);' : '' }}">
                                    <span style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:var(--ink-400);display:block;margin-bottom:10px;">Riwayat Pendidikan</span>
                                    <ul style="list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:8px;">
                                        @foreach($sditPrincipal->education as $edu)
                                            <li style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);">
                                                <strong style="display:block;color:var(--ink-900);">{{ $edu['degree'] ?? '' }}</strong>
                                                <span style="color:var(--ink-500);">{{ $edu['institution'] ?? '' }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if($sditPrincipal->leadership_vision)
                                <div style="flex:1;padding:24px 28px;">
                                    <span style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:var(--ink-400);display:block;margin-bottom:10px;">Visi Kepemimpinan</span>
                                    <p style="font-family:var(--font-sans);font-size:var(--text-sm);line-height:1.65;color:var(--ink-600);margin:0;">
                                        {{ $sditPrincipal->leadership_vision }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
            @if($tkitPrincipal)
                <div class="am-reveal" style="background:var(--surface-card);border:1px solid var(--border-default);border-radius:var(--radius-xl);box-shadow:var(--shadow-sm);overflow:hidden;display:flex;flex-wrap:wrap;align-items:stretch;">
                    <div class="am-principal-photo" style="overflow:hidden;background:var(--gold-100);">
                        @if($tkitPrincipal->photo_path)
                            <img src="{{ Storage::url($tkitPrincipal->photo_path) }}" alt="{{ $tkitPrincipal->name }}" class="am-principal-img" style="width:100%;height:100%;object-fit:cover;object-position:top center;display:block;">
                        @else
                            <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                                <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="var(--gold-500)" stroke-width="1.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="am-principal-body" style="flex:1 1 280px;padding:32px 36px;display:flex;flex-direction:column;justify-content:center;align-items:flex-start;">
                        <x-badge tone="gold" variant="soft" size="sm" style="margin-bottom:14px;">Kepala Sekolah · KB Raudhatul Jannah</x-badge>
                        <h2 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-2xl);color:var(--green-800);margin:0 0 6px;">
                            {{ $tkitPrincipal->name }}
                        </h2>
                        <span style="font-family:var(--font-sans);font-size:var(--text-sm);font-weight:600;color:var(--ink-500);display:block;margin-bottom:12px;">{{ $tkitPrincipal->position }}</span>
                        @if($tkitPrincipal->bio)
                            <p style="font-family:var(--font-sans);font-size:var(--text-md);line-height:1.75;color:var(--ink-600);margin:0;max-width:560px;">
                                {{ $tkitPrincipal->bio }}
                            </p>
                        @endif
                    </div>
                    @if(!empty($tkitPrincipal->education) || $tkitPrincipal->leadership_vision)
                        <div class="am-principal-extra" style="flex:1 1 280px;display:flex;flex-direction:column;">
                            @if(!empty($tkitPrincipal->education))
                                <div style="flex:1;padding:24px 28px;{{ $tkitPrincipal->leadership_vision ? 'border-bottom:1px solid var(--border-subtle);' : '' }}">
                                    <span style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:var(--ink-400);display:block;margin-bottom:10px;">Riwayat Pendidikan</span>
                                    <ul style="list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:8px;">
                                        @foreach($tkitPrincipal->education as $edu)
                                            <li style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);">
                                                <strong style="display:block;color:var(--ink-900);">{{ $edu['degree'] ?? '' }}</strong>
                                                <span style="color:var(--ink-500);">{{ $edu['institution'] ?? '' }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if($tkitPrincipal->leadership_vision)
                                <div style="flex:1;padding:24px 28px;">
                                    <span style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:600;letter-spacing:0.08em;text-transform:uppercase;color:var(--ink-400);display:block;margin-bottom:10px;">Visi Kepemimpinan</span>
                                    <p style="font-family:var(--font-sans);font-size:var(--text-sm);line-height:1.65;color:var(--ink-600);margin:0;">
                                        {{ $tkitPrincipal->leadership_vision }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>
    @endif

    {{-- ── Video Profil ──────────────────────────────────────────────────── --}}
    <section class="am-section" style="background:var(--cream-50);padding-top:calc(var(--section-y) / 2);padding-bottom:calc(var(--section-y) / 2);">
        <div class="am-container">
            <div class="am-reveal">
                <x-section-header
                    eyebrow="Profil Sekolah"
                    title="Mengenal AL MANAR lebih dekat"
                    align="center"
                    style="justify-content:center;margin-bottom:28px;"
                />
            </div>
            <div class="am-reveal" style="max-width:840px;margin:0 auto;">
                <div style="position:relative;aspect-ratio:16/9;border-radius:var(--radius-xl);overflow:hidden;box-shadow:var(--shadow-md);">
                    <iframe
                        src="https://www.youtube.com/embed/eVmC6DThB94"
                        title="Video Profil AL MANAR"
                        style="position:absolute;inset:0;width:100%;height:100%;border:0;"
                        loading="lazy"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen
                    ></iframe>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Kegiatan ─────────────────────────────────────────────────────── --}}
    @if($sditActivities->isNotEmpty() || $tkitActivities->isNotEmpty())
    <section class="am-section" style="background:var(--surface-card);padding-top:calc(var(--section-y) / 2);padding-bottom:calc(var(--section-y) / 3);">
        <div class="am-container">
            <div class="am-reveal" style="display:flex;align-items:flex-end;justify-content:space-between;gap:24px;flex-wrap:wrap;margin-bottom:28px;">
                <x-section-header eyebrow="Dokumentasi" title="Momen Kegiatan AL MANAR" lead="Keseruan belajar, beribadah, dan berkarya — diabadikan langsung dari lapangan." />
            </div>

            <div x-data="{ tab: 'sdit' }">
                {{-- Tab switcher --}}
                @if($sditActivities->isNotEmpty() && $tkitActivities->isNotEmpty())
                <div style="display:flex;gap:8px;margin-bottom:24px;border-bottom:2px solid var(--border-subtle);">
                    <button type="button" @click="tab='sdit'"
                        :style="tab==='sdit' ? 'border-bottom:2px solid var(--green-600);margin-bottom:-2px;color:var(--green-700);font-weight:600;' : 'color:var(--ink-400);'"
                        style="font-family:var(--font-sans);font-size:var(--text-sm);padding:10px 20px;background:none;border:none;border-bottom:2px solid transparent;cursor:pointer;transition:color .15s;">
                        SDIT AL MANAR
                    </button>
                    <button type="button" @click="tab='tkit'"
                        :style="tab==='tkit' ? 'border-bottom:2px solid var(--gold-500);margin-bottom:-2px;color:var(--gold-600);font-weight:600;' : 'color:var(--ink-400);'"
                        style="font-family:var(--font-sans);font-size:var(--text-sm);padding:10px 20px;background:none;border:none;border-bottom:2px solid transparent;cursor:pointer;transition:color .15s;">
                        KB Raudhatul Jannah
                    </button>
                </div>
                @endif

                {{-- Grid SDIT --}}
                @if($sditActivities->isNotEmpty())
                <div x-show="tab === 'sdit'" class="am-kegiatan-grid">
                    @foreach($sditActivities as $activity)
                        @php
                            $thumb = $activity->thumbnail_path
                                ? Storage::url($activity->thumbnail_path)
                                : ($activity->youtube_id
                                    ? "https://img.youtube.com/vi/{$activity->youtube_id}/hqdefault.jpg"
                                    : ($activity->photos->first()?->path ? Storage::url($activity->photos->first()->path) : null));
                        @endphp
                        <a href="{{ route('sdit.kegiatan') }}" class="am-reveal am-kegiatan-card" style="display:block;border-radius:var(--radius-xl);overflow:hidden;box-shadow:var(--shadow-sm);position:relative;background:var(--green-100);transition-delay:{{ $loop->index * 60 }}ms;">
                            @if($thumb)
                                <img src="{{ $thumb }}" alt="{{ $activity->title }}" class="am-kegiatan-img" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block;" loading="lazy">
                            @else
                                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--green-300)" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                </div>
                            @endif
                            <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(10,30,20,.85) 0%, rgba(10,30,20,.15) 50%, rgba(10,30,20,0) 75%);"></div>

                            {{-- Top badges --}}
                            <div style="position:absolute;top:12px;left:12px;right:12px;display:flex;justify-content:space-between;gap:8px;">
                                @if($activity->category)
                                    <span style="background:rgba(217,171,61,.95);color:#1A2E20;font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:4px 10px;border-radius:var(--radius-md);">{{ $activity->category }}</span>
                                @endif
                                @if($activity->youtube_id)
                                    <span style="background:rgba(0,0,0,.55);width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="#fff"><path d="M8 5v14l11-7z"/></svg>
                                    </span>
                                @endif
                            </div>

                            {{-- Bottom content --}}
                            <div style="position:absolute;bottom:14px;left:16px;right:16px;">
                                @if($activity->activity_date)
                                    <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;color:var(--gold-300);display:block;margin-bottom:4px;">{{ \Carbon\Carbon::parse($activity->activity_date)->translatedFormat('d M Y') }}</span>
                                @endif
                                <span style="font-family:var(--font-display);font-weight:700;font-size:var(--text-md);color:#FBF8F1;line-height:1.3;text-shadow:0 1px 6px rgba(0,0,0,.4);display:block;">{{ $activity->title }}</span>
                                <span class="am-kegiatan-cta" style="display:inline-flex;align-items:center;gap:5px;margin-top:8px;font-family:var(--font-sans);font-size:12px;font-weight:600;color:#FBF8F1;">
                                    Lihat Kegiatan
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
                @endif

                {{-- Grid TKIT --}}
                @if($tkitActivities->isNotEmpty())
                <div x-show="tab === 'tkit'" class="am-kegiatan-grid">
                    @foreach($tkitActivities as $activity)
                        @php
                            $thumb = $activity->thumbnail_path
                                ? Storage::url($activity->thumbnail_path)
                                : ($activity->youtube_id
                                    ? "https://img.youtube.com/vi/{$activity->youtube_id}/hqdefault.jpg"
                                    : ($activity->photos->first()?->path ? Storage::url($activity->photos->first()->path) : null));
                        @endphp
                        <a href="{{ route('tkit.kegiatan') }}" class="am-reveal am-kegiatan-card" style="display:block;border-radius:var(--radius-xl);overflow:hidden;box-shadow:var(--shadow-sm);position:relative;background:var(--gold-100);transition-delay:{{ $loop->index * 60 }}ms;">
                            @if($thumb)
                                <img src="{{ $thumb }}" alt="{{ $activity->title }}" class="am-kegiatan-img" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block;" loading="lazy">
                            @else
                                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--gold-400)" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                </div>
                            @endif
                            <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(40,28,4,.85) 0%, rgba(40,28,4,.15) 50%, rgba(40,28,4,0) 75%);"></div>

                            {{-- Top badges --}}
                            <div style="position:absolute;top:12px;left:12px;right:12px;display:flex;justify-content:space-between;gap:8px;">
                                @if($activity->category)
                                    <span style="background:rgba(56,118,79,.95);color:#FBF8F1;font-family:var(--font-sans);font-size:11px;font-weight:700;letter-spacing:.04em;text-transform:uppercase;padding:4px 10px;border-radius:var(--radius-md);">{{ $activity->category }}</span>
                                @endif
                                @if($activity->youtube_id)
                                    <span style="background:rgba(0,0,0,.55);width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="#fff"><path d="M8 5v14l11-7z"/></svg>
                                    </span>
                                @endif
                            </div>

                            {{-- Bottom content --}}
                            <div style="position:absolute;bottom:14px;left:16px;right:16px;">
                                @if($activity->activity_date)
                                    <span style="font-family:var(--font-sans);font-size:11px;font-weight:600;color:var(--gold-200);display:block;margin-bottom:4px;">{{ \Carbon\Carbon::parse($activity->activity_date)->translatedFormat('d M Y') }}</span>
                                @endif
                                <span style="font-family:var(--font-display);font-weight:700;font-size:var(--text-md);color:#FBF8F1;line-height:1.3;text-shadow:0 1px 6px rgba(0,0,0,.4);display:block;">{{ $activity->title }}</span>
                                <span class="am-kegiatan-cta" style="display:inline-flex;align-items:center;gap:5px;margin-top:8px;font-family:var(--font-sans);font-size:12px;font-weight:600;color:#FBF8F1;">
                                    Lihat Kegiatan
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- ── Ekstrakurikuler ────────────────────────────────────────────────── --}}
    @if(!empty($sdit?->eskul) || !empty($tkit?->eskul))
    <section class="am-section" style="background:var(--cream-50);padding-bottom:calc(var(--section-y) / 3);">
        <div class="am-container">
            <div class="am-reveal" style="margin-bottom:32px;">
                <x-section-header eyebrow="Ekstrakurikuler" title="Eskul AL MANAR" lead="Wadah minat & bakat siswa di luar jam pelajaran." />
            </div>

            <div x-data="{ tab: 'sdit', modal: null }" @keydown.escape.window="modal = null">

                {{-- Modal lightbox --}}
                <template x-teleport="body">
                    <div
                        x-show="modal !== null"
                        x-transition:enter="hero-fade-enter"
                        x-transition:enter-start="hero-fade-enter-start"
                        x-transition:enter-end="hero-fade-enter-end"
                        x-transition:leave="hero-fade-leave"
                        x-transition:leave-end="hero-fade-leave-end"
                        @click.self="modal = null"
                        style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.85);display:flex;align-items:center;justify-content:center;padding:24px;"
                        x-cloak
                    >
                        <div style="position:relative;max-width:560px;width:100%;margin:0 auto;display:flex;flex-direction:column;align-items:center;">
                            <button @click="modal = null" style="position:absolute;top:-44px;right:0;background:none;border:none;color:#fff;cursor:pointer;display:flex;align-items:center;gap:6px;font-family:var(--font-sans);font-size:var(--text-sm);opacity:.8;" onmouseenter="this.style.opacity=1" onmouseleave="this.style.opacity=.8">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                Tutup
                            </button>
                            <img :src="modal?.foto" :alt="modal?.nama" style="max-width:100%;max-height:80vh;object-fit:contain;border-radius:var(--radius-xl);display:block;">
                            <div style="margin-top:16px;text-align:center;">
                                <span style="font-family:var(--font-display);font-size:var(--text-lg);font-weight:600;color:#FBF8F1;" x-text="modal?.nama"></span>
                            </div>
                        </div>
                    </div>
                </template>

                {{-- Tab switcher --}}
                @if(!empty($sdit?->eskul) && !empty($tkit?->eskul))
                <div style="display:flex;gap:8px;margin-bottom:24px;border-bottom:2px solid var(--border-subtle);">
                    <button type="button" @click="tab='sdit'"
                        :style="tab==='sdit' ? 'border-bottom:2px solid var(--green-600);margin-bottom:-2px;color:var(--green-700);font-weight:600;' : 'color:var(--ink-400);'"
                        style="font-family:var(--font-sans);font-size:var(--text-sm);padding:10px 20px;background:none;border:none;border-bottom:2px solid transparent;cursor:pointer;transition:color .15s;">
                        SDIT AL MANAR
                    </button>
                    <button type="button" @click="tab='tkit'"
                        :style="tab==='tkit' ? 'border-bottom:2px solid var(--gold-500);margin-bottom:-2px;color:var(--gold-600);font-weight:600;' : 'color:var(--ink-400);'"
                        style="font-family:var(--font-sans);font-size:var(--text-sm);padding:10px 20px;background:none;border:none;border-bottom:2px solid transparent;cursor:pointer;transition:color .15s;">
                        TKIT AL MANAR
                    </button>
                </div>
                @endif

                {{-- Pill slider SDIT --}}
                @if(!empty($sdit?->eskul))
                <div x-show="tab === 'sdit'" class="am-eskul-track">
                    @foreach($sdit->eskul as $item)
                        @php $fotoUrl = !empty($item['foto']) ? Storage::url($item['foto']) : null; @endphp
                        <div style="flex:0 0 auto;width:104px;display:flex;flex-direction:column;align-items:center;gap:10px;text-align:center;">
                            <div
                                @if($fotoUrl) @click="modal = { foto: '{{ $fotoUrl }}', nama: '{{ addslashes($item['nama']) }}' }" class="am-eskul-avatar" @endif
                                style="width:96px;height:96px;border-radius:50%;overflow:hidden;background:var(--green-100);border:3px solid var(--green-200);display:flex;align-items:center;justify-content:center;flex-shrink:0;"
                            >
                                @if($fotoUrl)
                                    <img src="{{ $fotoUrl }}" alt="{{ $item['nama'] }}" style="width:100%;height:100%;object-fit:cover;display:block;" loading="lazy">
                                @else
                                    <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="var(--green-400)" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0 1 16 0v1"/></svg>
                                @endif
                            </div>
                            <div style="display:flex;flex-direction:column;gap:1px;">
                                <span style="font-family:var(--font-sans);font-size:var(--text-sm);font-weight:600;color:var(--ink-800);line-height:1.25;">{{ $item['nama'] }}</span>
                                @if(!empty($item['kategori']))
                                    <span style="font-family:var(--font-sans);font-size:11px;color:var(--ink-400);">{{ $item['kategori'] }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif

                {{-- Pill slider TKIT --}}
                @if(!empty($tkit?->eskul))
                <div x-show="tab === 'tkit'" class="am-eskul-track">
                    @foreach($tkit->eskul as $item)
                        @php $fotoUrl = !empty($item['foto']) ? Storage::url($item['foto']) : null; @endphp
                        <div style="flex:0 0 auto;width:104px;display:flex;flex-direction:column;align-items:center;gap:10px;text-align:center;">
                            <div
                                @if($fotoUrl) @click="modal = { foto: '{{ $fotoUrl }}', nama: '{{ addslashes($item['nama']) }}' }" class="am-eskul-avatar" @endif
                                style="width:96px;height:96px;border-radius:50%;overflow:hidden;background:var(--gold-100);border:3px solid var(--gold-200);display:flex;align-items:center;justify-content:center;flex-shrink:0;"
                            >
                                @if($fotoUrl)
                                    <img src="{{ $fotoUrl }}" alt="{{ $item['nama'] }}" style="width:100%;height:100%;object-fit:cover;display:block;" loading="lazy">
                                @else
                                    <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="var(--gold-500)" stroke-width="1.5"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0 1 16 0v1"/></svg>
                                @endif
                            </div>
                            <div style="display:flex;flex-direction:column;gap:1px;">
                                <span style="font-family:var(--font-sans);font-size:var(--text-sm);font-weight:600;color:var(--ink-800);line-height:1.25;">{{ $item['nama'] }}</span>
                                @if(!empty($item['kategori']))
                                    <span style="font-family:var(--font-sans);font-size:11px;color:var(--ink-400);">{{ $item['kategori'] }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- ── News preview ───────────────────────────────────────────────────── --}}
    @if($latestNews->isNotEmpty())
        <section class="am-section" style="background:var(--surface-card);padding-bottom:calc(var(--section-y) / 3);">
            <div class="am-container">
                <div class="am-reveal" style="display:flex;align-items:flex-end;justify-content:space-between;gap:24px;flex-wrap:wrap;margin-bottom:32px;">
                    <x-section-header eyebrow="Berita Terbaru" title="Kabar dari AL MANAR" />
                    <a href="{{ route('berita.index') }}" class="am-btn am-btn--outline am-btn--sm">
                        Lihat Semua Berita
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>
                <div class="am-grid-3 am-mobile-slider">
                    @foreach($latestNews as $news)
                        <div class="am-reveal" style="transition-delay:{{ $loop->index * 70 }}ms;">
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
            </div>
        </section>
    @endif

    {{-- ── Fasilitas ──────────────────────────────────────────────────────── --}}
    @if(!empty($sdit?->fasilitas) || !empty($tkit?->fasilitas))
    <section class="am-section" style="background:var(--green-50);">
        <div class="am-container">
            <div class="am-reveal" style="margin-bottom:36px;">
                <x-section-header eyebrow="Sarana & Prasarana" title="Fasilitas Sekolah" />
            </div>

            <div x-data="{ tab: 'sdit', modal: null }" @keydown.escape.window="modal = null">

                {{-- Modal --}}
                <template x-teleport="body">
                    <div
                        x-show="modal !== null"
                        x-transition:enter="hero-fade-enter"
                        x-transition:enter-start="hero-fade-enter-start"
                        x-transition:enter-end="hero-fade-enter-end"
                        x-transition:leave="hero-fade-leave"
                        x-transition:leave-end="hero-fade-leave-end"
                        @click.self="modal = null"
                        style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,.85);display:flex;align-items:center;justify-content:center;padding:24px;"
                        x-cloak
                    >
                        <div style="position:relative;max-width:900px;width:100%;margin:0 auto;display:flex;flex-direction:column;align-items:center;">
                            <button @click="modal = null" style="position:absolute;top:-44px;right:0;background:none;border:none;color:#fff;cursor:pointer;display:flex;align-items:center;gap:6px;font-family:var(--font-sans);font-size:var(--text-sm);opacity:.8;" onmouseenter="this.style.opacity=1" onmouseleave="this.style.opacity=.8">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                Tutup
                            </button>
                            <img :src="modal?.foto" :alt="modal?.nama" style="max-width:100%;max-height:80vh;object-fit:contain;border-radius:var(--radius-xl);display:block;">
                            <div style="margin-top:16px;text-align:center;">
                                <span style="font-family:var(--font-display);font-size:var(--text-lg);font-weight:600;color:#FBF8F1;" x-text="modal?.nama"></span>
                            </div>
                        </div>
                    </div>
                </template>

                {{-- Tab switcher --}}
                @if(!empty($sdit?->fasilitas) && !empty($tkit?->fasilitas))
                <div style="display:flex;gap:8px;margin-bottom:28px;border-bottom:2px solid var(--border-subtle);">
                    <button type="button" @click="tab='sdit'"
                        :style="tab==='sdit' ? 'border-bottom:2px solid var(--green-600);margin-bottom:-2px;color:var(--green-700);font-weight:600;' : 'color:var(--ink-400);'"
                        style="font-family:var(--font-sans);font-size:var(--text-sm);padding:10px 20px;background:none;border:none;border-bottom:2px solid transparent;cursor:pointer;transition:color .15s;">
                        SDIT AL MANAR
                    </button>
                    <button type="button" @click="tab='tkit'"
                        :style="tab==='tkit' ? 'border-bottom:2px solid var(--gold-500);margin-bottom:-2px;color:var(--gold-600);font-weight:600;' : 'color:var(--ink-400);'"
                        style="font-family:var(--font-sans);font-size:var(--text-sm);padding:10px 20px;background:none;border:none;border-bottom:2px solid transparent;cursor:pointer;transition:color .15s;">
                        TKIT AL MANAR
                    </button>
                </div>
                @endif

                {{-- Grid SDIT --}}
                @if(!empty($sdit?->fasilitas))
                <div x-show="tab === 'sdit'" class="am-fasilitas-grid am-mobile-slider">
                    @foreach($sdit->fasilitas as $item)
                    @php $fotoUrl = !empty($item['foto']) ? Storage::url($item['foto']) : null; @endphp
                    <div
                        class="am-fasilitas-card"
                        @if($fotoUrl) @click="modal = { foto: '{{ $fotoUrl }}', nama: '{{ addslashes($item['nama']) }}' }" @endif
                        style="min-width:0;position:relative;aspect-ratio:1/1;border-radius:var(--radius-xl);overflow:hidden;box-shadow:var(--shadow-sm);cursor:{{ $fotoUrl ? 'pointer' : 'default' }};background:var(--green-100);"
                    >
                        @if($fotoUrl)
                            <img src="{{ $fotoUrl }}" alt="{{ $item['nama'] }}" class="am-fasilitas-img" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block;transition:transform .4s ease;" loading="lazy">
                        @else
                            <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                                <span style="font-size:2.8rem;">{{ $item['icon'] ?? '🏫' }}</span>
                            </div>
                        @endif
                        <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(10,30,20,.82) 0%, rgba(10,30,20,.35) 38%, rgba(10,30,20,0) 65%);"></div>
                        <span style="position:absolute;top:12px;left:12px;width:34px;height:34px;border-radius:50%;background:rgba(251,248,241,.92);display:flex;align-items:center;justify-content:center;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--green-700)" stroke-width="2"><path d="M15 3h6v6M10 14L21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
                        </span>
                        <span style="position:absolute;bottom:14px;left:16px;right:16px;font-family:var(--font-sans);font-size:var(--text-sm);font-weight:700;color:#FBF8F1;line-height:1.3;text-shadow:0 1px 6px rgba(0,0,0,.4);">{{ $item['nama'] }}</span>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Grid TKIT --}}
                @if(!empty($tkit?->fasilitas))
                <div x-show="tab === 'tkit'" class="am-fasilitas-grid am-mobile-slider">
                    @foreach($tkit->fasilitas as $item)
                    @php $fotoUrl = !empty($item['foto']) ? Storage::url($item['foto']) : null; @endphp
                    <div
                        class="am-fasilitas-card"
                        @if($fotoUrl) @click="modal = { foto: '{{ $fotoUrl }}', nama: '{{ addslashes($item['nama']) }}' }" @endif
                        style="min-width:0;position:relative;aspect-ratio:1/1;border-radius:var(--radius-xl);overflow:hidden;box-shadow:var(--shadow-sm);cursor:{{ $fotoUrl ? 'pointer' : 'default' }};background:var(--gold-100);"
                    >
                        @if($fotoUrl)
                            <img src="{{ $fotoUrl }}" alt="{{ $item['nama'] }}" class="am-fasilitas-img" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;display:block;transition:transform .4s ease;" loading="lazy">
                        @else
                            <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;">
                                <span style="font-size:2.8rem;">{{ $item['icon'] ?? '🏫' }}</span>
                            </div>
                        @endif
                        <div style="position:absolute;inset:0;background:linear-gradient(to top, rgba(40,28,4,.82) 0%, rgba(40,28,4,.35) 38%, rgba(40,28,4,0) 65%);"></div>
                        <span style="position:absolute;top:12px;left:12px;width:34px;height:34px;border-radius:50%;background:rgba(251,248,241,.92);display:flex;align-items:center;justify-content:center;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--gold-600)" stroke-width="2"><path d="M15 3h6v6M10 14L21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
                        </span>
                        <span style="position:absolute;bottom:14px;left:16px;right:16px;font-family:var(--font-sans);font-size:var(--text-sm);font-weight:700;color:#FBF8F1;line-height:1.3;text-shadow:0 1px 6px rgba(0,0,0,.4);">{{ $item['nama'] }}</span>
                    </div>
                    @endforeach
                </div>
                @endif

            </div>
        </div>
    </section>
    @endif

    {{-- ── PPDB CTA ────────────────────────────────────────────────────────── --}}
    @if($sdit?->is_ppdb)
    {{-- PPDB Popup Modal — muncul setiap kali halaman dimuat/reload --}}
    <div
        x-data="{ open: false }"
        x-init="setTimeout(() => open = true, 150)"
        x-show="open"
        x-cloak
        @keydown.escape.window="open = false"
        style="position:fixed;inset:0;z-index:1000;"
    >
        {{-- Backdrop --}}
        <div
            x-show="open"
            x-transition:enter="am-modal-backdrop-enter"
            x-transition:enter-start="am-modal-backdrop-enter-start"
            x-transition:enter-end="am-modal-backdrop-enter-end"
            x-transition:leave="am-modal-backdrop-leave"
            x-transition:leave-start="am-modal-backdrop-leave-start"
            x-transition:leave-end="am-modal-backdrop-leave-end"
            @click="open = false"
            style="position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(15,30,23,0.65);backdrop-filter:blur(2px);"
        ></div>

        {{-- Modal Card --}}
        <div
            x-show="open"
            x-transition:enter="am-modal-card-enter"
            x-transition:enter-start="am-modal-card-enter-start"
            x-transition:enter-end="am-modal-card-enter-end"
            x-transition:leave="am-modal-card-leave"
            x-transition:leave-start="am-modal-card-leave-start"
            x-transition:leave-end="am-modal-card-leave-end"
            role="dialog"
            aria-modal="true"
            aria-labelledby="ppdb-modal-title"
            style="position:fixed;top:50%;left:50%;transform:translate(-50%,-50%);width:calc(100% - 40px);max-width:480px;background:var(--surface-card);border-radius:var(--radius-xl);box-shadow:var(--shadow-lg);overflow:hidden;"
        >
            {{-- Close button --}}
            <button
                type="button"
                @click="open = false"
                aria-label="Tutup"
                style="position:absolute;top:14px;right:14px;width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,.9);border:none;display:flex;align-items:center;justify-content:center;cursor:pointer;z-index:2;transition:background 140ms ease;"
                onmouseover="this.style.background='#fff'"
                onmouseout="this.style.background='rgba(255,255,255,.9)'"
            >
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--ink-700)" stroke-width="2.4" stroke-linecap="round"><path d="M6 6l12 12M18 6L6 18"/></svg>
            </button>

            {{-- Header --}}
            <div style="position:relative;background:var(--green-600);padding:36px 28px 28px;text-align:center;overflow:hidden;">
                <div style="position:absolute;inset:0;background-image:var(--pattern-girih);opacity:.25;" aria-hidden="true"></div>
                <div style="position:relative;">
                    <span style="display:inline-flex;align-items:center;gap:8px;font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:var(--gold-300);">
                        <span style="width:18px;height:2px;background:var(--gold-400);border-radius:2px;"></span>
                        PPDB {{ date('Y') }}/{{ date('Y') + 1 }} Telah Dibuka
                        <span style="width:18px;height:2px;background:var(--gold-400);border-radius:2px;"></span>
                    </span>
                    <h2 id="ppdb-modal-title" style="font-family:var(--font-display);font-weight:700;font-size:var(--text-2xl);line-height:1.2;color:#FBF8F1;margin:14px 0 0;">
                        Daftarkan Putra-Putri Anda Sekarang
                    </h2>
                </div>
            </div>

            {{-- Body --}}
            <div style="padding:24px 28px 28px;text-align:center;">
                <p style="font-family:var(--font-sans);font-size:var(--text-sm);line-height:1.65;color:var(--text-body);margin:0 0 22px;">
                    Tempat terbatas. Proses pendaftaran online — mudah, cepat, dan tidak perlu datang ke sekolah dulu.
                </p>

                <div style="display:flex;flex-direction:column;gap:10px;">
                    @if($sdit?->is_ppdb)
                    <a href="{{ route('sdit.pendaftaran') }}" class="am-btn am-btn--primary am-btn--lg am-btn--block">
                        Daftar SDIT AL MANAR
                    </a>
                    @endif
                    @if($tkit?->is_ppdb)
                    <a href="{{ route('tkit.pendaftaran') }}" class="am-btn am-btn--secondary am-btn--lg am-btn--block">
                        Daftar KB Raudhatul Jannah
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

</x-layouts.app>
