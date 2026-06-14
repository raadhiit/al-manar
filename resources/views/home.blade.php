<x-layouts.app navActive="home" title="Beranda" description="Yayasan AL MANAR Kota Bekasi — Pendidikan Islam terpadu SDIT & TKIT yang membentuk generasi Qur'ani, berakhlak mulia, dan berprestasi.">

    {{-- ── Hero ─────────────────────────────────────────────────────────── --}}
    <section style="background:var(--cream-50);position:relative;overflow:hidden;">
        <div class="am-container">
            <div class="am-hero-grid">
                {{-- Copy --}}
                <div style="display:flex;flex-direction:column;gap:24px;max-width:560px;">
                    <span class="am-eyebrow">Yayasan AL MANAR · Kota Bekasi</span>

                    <h1 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-5xl);line-height:1.06;letter-spacing:-0.025em;color:var(--ink-900);margin:0;">
                        Menumbuhkan generasi <span style="color:var(--gold-500);">Qur'ani</span> yang berakhlak &amp; berprestasi
                    </h1>

                    <p style="font-family:var(--font-sans);font-size:var(--text-md);line-height:1.7;color:var(--ink-500);margin:0;">
                        Pendidikan Islam terpadu dari TK hingga sekolah dasar — memadukan kurikulum nasional, pembinaan akhlak, dan tahfizh Al-Qur'an di lingkungan yang hangat dan aman.
                    </p>

                    <div style="display:flex;gap:14px;flex-wrap:wrap;margin-top:4px;">
                        <a href="{{ route('sdit.pendaftaran') }}" class="am-btn am-btn--primary am-btn--lg">Daftar Sekarang</a>
                        <a href="{{ route('sdit.index') }}" class="am-btn am-btn--outline am-btn--lg">Profil Sekolah</a>
                    </div>
                </div>

                {{-- Hero image --}}
            <div class="am-hero-image" style="position:relative;">
                <div style="border-radius:var(--radius-2xl);overflow:hidden;border:1px solid var(--border-default);box-shadow:var(--shadow-lg);background:var(--green-100);height:420px;display:flex;align-items:center;justify-content:center;">
                    @if($yayasan?->logo_path)
                        <img src="{{ Storage::url($yayasan->logo_path) }}" alt="YAYASAN AL MANAR" style="width:100%;height:100%;object-fit:cover;" loading="eager">
                    @else
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="var(--green-400)" stroke-width="1"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    @endif
                </div>

                {{-- Floating card: Arabic name --}}
                <div style="position:absolute;left:-18px;bottom:28px;background:#fff;border-radius:var(--radius-lg);box-shadow:var(--shadow-md);border:1px solid var(--border-default);padding:14px 18px;display:flex;align-items:center;gap:13px;">
                    <x-logo variant="mark" :size="42" />
                    <div style="display:flex;flex-direction:column;">
                        <span class="am-arabic" style="font-size:22px;color:var(--green-700);line-height:1;">المنار</span>
                        <span style="font-family:var(--font-sans);font-size:12px;color:var(--ink-500);margin-top:3px;">Cahaya Ilmu, Akhlak Mulia</span>
                    </div>
                </div>

                {{-- PPDB badge --}}
                @if($yayasan?->is_ppdb)
                <div style="position:absolute;right:-14px;top:24px;">
                    <x-badge tone="gold" variant="solid" size="md" style="color:#fff;">PPDB {{ date('Y') }} Dibuka</x-badge>
                </div>
                @endif
            </div>
        </div>{{-- end .am-hero-grid --}}

        {{-- Stats — full width --}}
        <div style="display:flex;gap:36px;padding-top:22px;padding-bottom:28px;border-top:1px solid var(--border-subtle);flex-wrap:wrap;justify-content:space-between;">
            <x-stat value="A" label="Akreditasi" sublabel="SDIT & TKIT" tone="gold" />
            <x-stat value="1.200+" label="Alumni" sublabel="Sejak 2009" />
            <x-stat value="40+" label="Tenaga Pendidik" sublabel="Tersertifikasi" />
        </div>
        </div>{{-- end .am-container --}}
    </section>

    {{-- ── Schools split ─────────────────────────────────────────────────── --}}
    <section class="am-section" style="background:var(--surface-page);">
        <div class="am-container">
            <div class="am-reveal">
                <x-section-header
                    eyebrow="Unit Pendidikan"
                    title="Satu yayasan, dua jenjang terpadu"
                    lead="Pendidikan Islam yang berkesinambungan — dari usia dini hingga sekolah dasar."
                    style="margin-bottom:36px;"
                />
            </div>

            <div class="am-grid-2">
                <div class="am-reveal">
                    <x-school-card
                        level="SDIT"
                        name="SDIT AL MANAR"
                        tagline="Sekolah Dasar Islam Terpadu"
                        description="Kurikulum nasional terintegrasi nilai Islam, program tahfizh, dan pembinaan karakter yang kuat."
                        ageRange="7–12 tahun"
                        accreditation="{{ $sdit?->accreditation ?? 'A' }}"
                        :image="$sdit?->logo_path ? Storage::url($sdit->logo_path) : null"
                        :points="['Target hafalan hingga 3 juz', 'Pembelajaran bilingual & literasi digital', 'Ekstrakurikuler lengkap & pramuka SIT']"
                        :href="route('sdit.index')"
                    />
                </div>
                <div class="am-reveal" style="transition-delay:80ms;">
                    <x-school-card
                        level="TKIT"
                        name="TKIT AL MANAR"
                        tagline="TK Islam Terpadu"
                        description="Belajar sambil bermain dengan pembiasaan ibadah, adab, dan stimulasi tumbuh kembang yang menyenangkan."
                        ageRange="4–6 tahun"
                        accreditation="{{ $tkit?->accreditation ?? 'A' }}"
                        :image="$tkit?->logo_path ? Storage::url($tkit->logo_path) : null"
                        :points="['Sentra bermain edukatif', 'Pembiasaan sholat, doa & hadits', 'Rasio guru–murid ideal']"
                        :href="route('tkit.index')"
                    />
                </div>
            </div>
        </div>
    </section>

    {{-- ── Achievements band ──────────────────────────────────────────────── --}}
    <section class="am-section" style="background:var(--green-800);position:relative;overflow:hidden;">
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
    </section>

    {{-- ── Fasilitas ──────────────────────────────────────────────────────── --}}
    @if(!empty($sdit?->fasilitas) || !empty($tkit?->fasilitas))
    <section class="am-section" style="background:var(--surface-page);">
        <div class="am-container">
            <div class="am-reveal" style="margin-bottom:36px;">
                <x-section-header eyebrow="Sarana & Prasarana" title="Fasilitas Sekolah" />
            </div>

            <div x-data="{ tab: 'sdit', modal: null }" @keydown.escape.window="modal = null">

                {{-- Modal --}}
                <template x-teleport="body">
                    <div
                        x-show="modal !== null"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-end="opacity-0"
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
                <div x-show="tab === 'sdit'" class="am-fasilitas-grid">
                    @foreach($sdit->fasilitas as $item)
                    @php $fotoUrl = !empty($item['foto']) ? Storage::url($item['foto']) : null; @endphp
                    <div
                        class="am-fasilitas-card"
                        @if($fotoUrl) @click="modal = { foto: '{{ $fotoUrl }}', nama: '{{ addslashes($item['nama']) }}' }" @endif
                        style="min-width:0;background:var(--surface-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);overflow:hidden;box-shadow:var(--shadow-sm);cursor:{{ $fotoUrl ? 'pointer' : 'default' }};transition:box-shadow .2s,transform .2s;"
                    >
                        <div style="aspect-ratio:4/3;overflow:hidden;background:var(--cream-100);position:relative;">
                            @if($fotoUrl)
                                <img src="{{ $fotoUrl }}" alt="{{ $item['nama'] }}" style="width:100%;height:100%;object-fit:cover;display:block;" loading="lazy">
                                <div class="fasilitas-overlay" style="position:absolute;inset:0;background:rgba(0,0,0,.35);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .2s;">
                                    <div style="width:44px;height:44px;background:rgba(255,255,255,.92);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--ink-800)" stroke-width="2"><path d="M15 3h6v6M10 14L21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
                                    </div>
                                </div>
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                                    <span style="font-size:2.5rem;">{{ $item['icon'] ?? '🏫' }}</span>
                                </div>
                            @endif
                        </div>
                        <div style="padding:14px 16px;">
                            <span style="font-family:var(--font-sans);font-size:var(--text-sm);font-weight:600;color:var(--ink-800);">{{ $item['nama'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Grid TKIT --}}
                @if(!empty($tkit?->fasilitas))
                <div x-show="tab === 'tkit'" class="am-fasilitas-grid">
                    @foreach($tkit->fasilitas as $item)
                    @php $fotoUrl = !empty($item['foto']) ? Storage::url($item['foto']) : null; @endphp
                    <div
                        class="am-fasilitas-card"
                        @if($fotoUrl) @click="modal = { foto: '{{ $fotoUrl }}', nama: '{{ addslashes($item['nama']) }}' }" @endif
                        style="min-width:0;background:var(--surface-card);border:1px solid var(--border-subtle);border-radius:var(--radius-xl);overflow:hidden;box-shadow:var(--shadow-sm);cursor:{{ $fotoUrl ? 'pointer' : 'default' }};transition:box-shadow .2s,transform .2s;"
                    >
                        <div style="aspect-ratio:4/3;overflow:hidden;background:var(--cream-100);position:relative;">
                            @if($fotoUrl)
                                <img src="{{ $fotoUrl }}" alt="{{ $item['nama'] }}" style="width:100%;height:100%;object-fit:cover;display:block;" loading="lazy">
                                <div class="fasilitas-overlay" style="position:absolute;inset:0;background:rgba(0,0,0,.35);display:flex;align-items:center;justify-content:center;opacity:0;transition:opacity .2s;">
                                    <div style="width:44px;height:44px;background:rgba(255,255,255,.92);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--ink-800)" stroke-width="2"><path d="M15 3h6v6M10 14L21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
                                    </div>
                                </div>
                            @else
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                                    <span style="font-size:2.5rem;">{{ $item['icon'] ?? '🏫' }}</span>
                                </div>
                            @endif
                        </div>
                        <div style="padding:14px 16px;">
                            <span style="font-family:var(--font-sans);font-size:var(--text-sm);font-weight:600;color:var(--ink-800);">{{ $item['nama'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

            </div>
        </div>
    </section>
    @endif

    {{-- ── Ekstrakurikuler ────────────────────────────────────────────────── --}}
    @if(!empty($sdit?->eskul) || !empty($tkit?->eskul))
    <section class="am-section" style="background:var(--cream-50);">
        <div class="am-container">
            <div class="am-reveal" style="margin-bottom:36px;">
                <x-section-header eyebrow="Kegiatan Siswa" title="Ekstrakurikuler" />
            </div>

            <div x-data="{ tab: 'sdit' }">
                {{-- Tab switcher --}}
                <div style="display:flex;gap:8px;margin-bottom:28px;border-bottom:2px solid var(--border-subtle);padding-bottom:0;">
                    @if(!empty($sdit?->eskul))
                    <button type="button" @click="tab='sdit'"
                        :style="tab==='sdit' ? 'border-bottom:2px solid var(--green-600);margin-bottom:-2px;color:var(--green-700);font-weight:600;' : 'color:var(--ink-400);'"
                        style="font-family:var(--font-sans);font-size:var(--text-sm);padding:10px 20px;background:none;border:none;border-bottom:2px solid transparent;cursor:pointer;transition:color .15s;">
                        SDIT AL MANAR
                    </button>
                    @endif
                    @if(!empty($tkit?->eskul))
                    <button type="button" @click="tab='tkit'"
                        :style="tab==='tkit' ? 'border-bottom:2px solid var(--gold-500);margin-bottom:-2px;color:var(--gold-600);font-weight:600;' : 'color:var(--ink-400);'"
                        style="font-family:var(--font-sans);font-size:var(--text-sm);padding:10px 20px;background:none;border:none;border-bottom:2px solid transparent;cursor:pointer;transition:color .15s;">
                        TKIT AL MANAR
                    </button>
                    @endif
                </div>

                @if(!empty($sdit?->eskul))
                @php $eskulSditByKat = collect($sdit->eskul)->groupBy('kategori'); @endphp
                <div x-show="tab==='sdit'" x-transition style="display:flex;flex-direction:column;gap:24px;">
                    @foreach($eskulSditByKat as $kat => $items)
                    <div>
                        @if($kat)
                            <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--ink-400);margin-bottom:12px;">{{ $kat }}</div>
                        @endif
                        <div style="display:flex;flex-wrap:wrap;gap:10px;">
                            @foreach($items as $eskul)
                            <span style="font-family:var(--font-sans);font-size:var(--text-sm);font-weight:500;color:var(--green-800);background:var(--green-50,#f0fdf4);border:1px solid var(--green-200);border-radius:var(--radius-full,9999px);padding:6px 16px;">
                                {{ $eskul['nama'] }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                @if(!empty($tkit?->eskul))
                @php $eskulTkitByKat = collect($tkit->eskul)->groupBy('kategori'); @endphp
                <div x-show="tab==='tkit'" x-transition style="display:flex;flex-direction:column;gap:24px;">
                    @foreach($eskulTkitByKat as $kat => $items)
                    <div>
                        @if($kat)
                            <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--ink-400);margin-bottom:12px;">{{ $kat }}</div>
                        @endif
                        <div style="display:flex;flex-wrap:wrap;gap:10px;">
                            @foreach($items as $eskul)
                            <span style="font-family:var(--font-sans);font-size:var(--text-sm);font-weight:500;color:var(--gold-800);background:var(--gold-50,#fffbeb);border:1px solid var(--gold-200);border-radius:var(--radius-full,9999px);padding:6px 16px;">
                                {{ $eskul['nama'] }}
                            </span>
                            @endforeach
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
        <section class="am-section" style="background:var(--cream-100);">
            <div class="am-container">
                <div class="am-reveal" style="display:flex;align-items:flex-end;justify-content:space-between;gap:24px;flex-wrap:wrap;margin-bottom:32px;">
                    <x-section-header
                        eyebrow="Berita Terbaru"
                        title="Kabar dari AL MANAR"
                    />
                    <a href="{{ route('berita.index') }}" class="am-btn am-btn--outline am-btn--sm">
                        Lihat Semua Berita
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </a>
                </div>

                <div class="am-grid-3">
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

    {{-- ── PPDB CTA ────────────────────────────────────────────────────────── --}}
    <section class="am-section" style="background:var(--green-600);position:relative;overflow:hidden;">
        <div style="position:absolute;inset:0;background-image:var(--pattern-girih);opacity:.3;" aria-hidden="true"></div>
        <div class="am-container" style="position:relative;text-align:center;display:flex;flex-direction:column;align-items:center;gap:24px;">
            <span style="display:inline-flex;align-items:center;gap:8px;font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:var(--gold-300);">
                <span style="width:18px;height:2px;background:var(--gold-400);border-radius:2px;"></span>
                PPDB {{ date('Y') }}/{{ date('Y') + 1 }}
                <span style="width:18px;height:2px;background:var(--gold-400);border-radius:2px;"></span>
            </span>

            <h2 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-4xl);line-height:1.1;color:#FBF8F1;margin:0;max-width:640px;">
                Daftarkan putra-putri Anda sekarang
            </h2>

            <p style="font-family:var(--font-sans);font-size:var(--text-md);line-height:1.65;color:var(--gold-100);opacity:.9;margin:0;max-width:520px;">
                Tempat terbatas. Proses pendaftaran online — mudah, cepat, dan tidak perlu datang ke sekolah dulu.
            </p>

            <div style="display:flex;gap:14px;flex-wrap:wrap;justify-content:center;margin-top:8px;">
                <a href="{{ route('sdit.pendaftaran') }}" class="am-btn am-btn--secondary am-btn--lg">
                    Daftar SDIT AL MANAR
                </a>
                <a href="{{ route('tkit.pendaftaran') }}" class="am-btn am-btn--onbrand am-btn--lg">
                    Daftar TKIT AL MANAR
                </a>
            </div>
        </div>
    </section>

</x-layouts.app>
