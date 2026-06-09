<x-layouts.app navActive="portal" title="Kalender Pendidikan" description="Kalender akademik SDIT dan TKIT AL MANAR per tahun ajaran.">

    {{-- ── Page header ─────────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);padding:40px 0 36px;">
        <div class="am-container">
            <nav style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--gold-200);display:flex;align-items:center;gap:8px;margin-bottom:20px;opacity:.8;">
                <a href="{{ route('home') }}" style="color:inherit;text-decoration:none;">Beranda</a>
                <span>/</span>
                <span>Portal Akademik</span>
                <span>/</span>
                <span>Kalender</span>
            </nav>
            <x-section-header
                eyebrow="Portal Akademik"
                title="Kalender Pendidikan"
                lead="Kalender akademik resmi per tahun ajaran untuk SDIT dan TKIT AL MANAR."
                tone="onbrand"
            />
            {{-- Sub-nav portal --}}
            <div style="display:flex;gap:8px;flex-wrap:wrap;margin-top:28px;">
                <a href="{{ route('portal.kalender') }}" class="am-btn am-btn--secondary am-btn--sm">Kalender</a>
                <a href="{{ route('portal.kurikulum') }}" class="am-btn am-btn--onbrand am-btn--sm">Kurikulum</a>
                <a href="{{ route('portal.pengumuman') }}" class="am-btn am-btn--onbrand am-btn--sm">Pengumuman</a>
                <a href="{{ route('portal.download') }}" class="am-btn am-btn--onbrand am-btn--sm">Download</a>
            </div>
        </div>
    </section>

    <section class="am-section" style="background:var(--cream-50);">
        <div class="am-container">

            {{-- Filter jenjang --}}
            @php $filters = ['' => 'Semua', 'sdit' => 'SDIT AL MANAR', 'tkit' => 'TKIT AL MANAR']; @endphp
            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:36px;">
                @foreach($filters as $key => $label)
                    @php $isActive = $key === '' ? is_null($jenjang) : $jenjang === $key; @endphp
                    <a
                        href="{{ $key ? route('portal.kalender', ['jenjang' => $key]) : route('portal.kalender') }}"
                        class="am-btn am-btn--sm {{ $isActive ? 'am-btn--primary' : 'am-btn--outline' }}"
                    >{{ $label }}</a>
                @endforeach
            </div>

            @if($calendars->isNotEmpty())
                <div style="display:flex;flex-direction:column;gap:14px;">
                    @foreach($calendars as $cal)
                        <div class="am-reveal am-card" style="padding:24px 28px;display:flex;align-items:center;gap:20px;flex-wrap:wrap;">
                            {{-- PDF icon --}}
                            <div style="width:52px;height:52px;background:var(--green-50,var(--cream-100));border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                            </div>

                            {{-- Info --}}
                            <div style="flex:1;min-width:0;">
                                <div style="font-family:var(--font-display);font-weight:600;font-size:var(--text-base);color:var(--ink-900);margin-bottom:6px;">{{ $cal->title }}</div>
                                <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
                                    <span style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-500);">
                                        Tahun Ajaran {{ $cal->academic_year }}
                                    </span>
                                    @if($cal->school)
                                        <x-badge
                                            :tone="$cal->school->level === 'sdit' ? 'sdit' : 'tkit'"
                                            variant="soft"
                                            size="sm"
                                        >{{ $cal->school->name }}</x-badge>
                                    @endif
                                </div>
                            </div>

                            {{-- Download --}}
                            @if($cal->file_path)
                                <a
                                    href="{{ Storage::url($cal->file_path) }}"
                                    target="_blank"
                                    class="am-btn am-btn--outline am-btn--sm"
                                    style="flex-shrink:0;display:inline-flex;align-items:center;gap:6px;"
                                >
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                    Unduh
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align:center;padding:80px 20px;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--green-300)" stroke-width="1.5" style="display:block;margin:0 auto 16px;"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--ink-400);margin:0;">
                        Belum ada kalender yang dipublikasikan.
                    </p>
                </div>
            @endif

        </div>
    </section>

</x-layouts.app>
