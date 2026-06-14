<x-layouts.app navActive="portal" title="Pengumuman Akademik" description="Pengumuman dan informasi akademik SDIT dan TKIT AL MANAR.">

    {{-- ── Page header ─────────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);padding:40px 0 36px;">
        <div class="am-container">
            <nav style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--gold-200);display:flex;align-items:center;gap:8px;margin-bottom:20px;opacity:.8;">
                <a href="{{ route('home') }}" style="color:inherit;text-decoration:none;">Beranda</a>
                <span>/</span>
                <span>Portal Akademik</span>
                <span>/</span>
                <span>Pengumuman</span>
            </nav>
            <x-section-header
                eyebrow="Portal Akademik"
                title="Pengumuman Akademik"
                lead="Jadwal ujian, penerimaan rapor, libur sekolah, dan informasi akademik lainnya."
                tone="onbrand"
            />
            {{-- Sub-nav portal --}}
            <div style="display:flex;gap:8px;flex-wrap:wrap;margin-top:28px;">
                <a href="{{ route('portal.kalender') }}" class="am-btn am-btn--onbrand am-btn--sm">Kalender</a>
                <a href="{{ route('portal.kurikulum') }}" class="am-btn am-btn--onbrand am-btn--sm">Kurikulum</a>
                <a href="{{ route('portal.pengumuman') }}" class="am-btn am-btn--secondary am-btn--sm">Pengumuman</a>
                <a href="{{ route('portal.download') }}" class="am-btn am-btn--onbrand am-btn--sm">Download</a>
            </div>
        </div>
    </section>

    <section class="am-section" style="background:var(--cream-50);"
        x-data="{
            filter: 'semua',
            get visible() {
                return this.filter === 'semua'
                    ? {{ $announcements->count() }}
                    : document.querySelectorAll('[data-jenjang=\'' + this.filter + '\']').length;
            }
        }"
    >
        <div class="am-container">

            {{-- Filter Alpine --}}
            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:36px;">
                @foreach(['semua' => 'Semua', 'sdit' => 'SDIT AL MANAR', 'tkit' => 'TKIT AL MANAR'] as $key => $label)
                    <button
                        type="button"
                        @click="filter = '{{ $key }}'"
                        :class="filter === '{{ $key }}' ? 'am-btn--primary' : 'am-btn--outline'"
                        class="am-btn am-btn--sm"
                    >{{ $label }}</button>
                @endforeach
            </div>

            @if($announcements->isNotEmpty())
                <div style="display:flex;flex-direction:column;gap:18px;">
                    @foreach($announcements as $ann)
                        @php
                            $level = $ann->school?->level; // 'sdit' | 'tkit' | null
                            $dataJenjang = $level ?? 'semua';
                        @endphp
                        <div
                            class="am-reveal am-card"
                            data-jenjang="{{ $dataJenjang }}"
                            x-show="filter === 'semua' || filter === '{{ $dataJenjang }}'"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            style="padding:28px 32px;"
                        >
                            {{-- Header --}}
                            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:16px;flex-wrap:wrap;margin-bottom:14px;">
                                <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                                    @if($ann->category)
                                        <x-badge tone="gold" variant="soft" size="sm">{{ $ann->category }}</x-badge>
                                    @endif
                                    @if($ann->school)
                                        <x-badge
                                            :tone="$ann->school->level === 'sdit' ? 'sdit' : 'tkit'"
                                            variant="soft"
                                            size="sm"
                                        >{{ $ann->school->level === 'sdit' ? 'SDIT' : 'TKIT' }}</x-badge>
                                    @endif
                                </div>
                                <span style="font-family:var(--font-sans);font-size:var(--text-xs);color:var(--ink-400);white-space:nowrap;">
                                    {{ $ann->published_at?->translatedFormat('d M Y') }}
                                </span>
                            </div>

                            {{-- Title --}}
                            <h3 style="font-family:var(--font-display);font-weight:600;font-size:var(--text-xl);color:var(--ink-900);margin:0 0 16px;line-height:1.3;">
                                {{ $ann->title }}
                            </h3>

                            {{-- Body --}}
                            <div style="font-family:var(--font-sans);font-size:var(--text-sm);line-height:1.75;color:var(--ink-700);">
                                {!! $ann->body !!}
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Empty state saat filter aktif tidak ada hasilnya --}}
                <div
                    x-cloak
                    x-show="filter !== 'semua' && document.querySelectorAll('[data-jenjang=\'' + filter + '\']:not([style*=\'display: none\'])').length === 0"
                    style="text-align:center;padding:80px 20px;"
                >
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--green-300)" stroke-width="1.5" style="display:block;margin:0 auto 16px;"><path d="M15 17H9M21 10H3M21 7H3M21 13H3M21 17H18M3 17h3"/><rect x="3" y="3" width="18" height="18" rx="2"/></svg>
                    <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--ink-400);margin:0;">
                        Belum ada pengumuman untuk jenjang ini.
                    </p>
                </div>
            @else
                <div style="text-align:center;padding:80px 20px;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--green-300)" stroke-width="1.5" style="display:block;margin:0 auto 16px;"><path d="M15 17H9M21 10H3M21 7H3M21 13H3M21 17H18M3 17h3"/><rect x="3" y="3" width="18" height="18" rx="2"/></svg>
                    <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--ink-400);margin:0;">
                        Belum ada pengumuman yang dipublikasikan.
                    </p>
                </div>
            @endif

        </div>
    </section>

</x-layouts.app>
