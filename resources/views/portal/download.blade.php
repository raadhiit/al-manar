<x-layouts.app navActive="portal" title="Download Area" description="Unduh silabus, modul, dan formulir dari Yayasan AL MANAR.">

    {{-- ── Page header ─────────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);padding:40px 0 36px;">
        <div class="am-container">
            <nav style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--gold-200);display:flex;align-items:center;gap:8px;margin-bottom:20px;opacity:.8;">
                <a href="{{ route('home') }}" style="color:inherit;text-decoration:none;">Beranda</a>
                <span>/</span>
                <span>Portal Akademik</span>
                <span>/</span>
                <span>Download</span>
            </nav>
            <x-section-header
                eyebrow="Portal Akademik"
                title="Download Area"
                lead="Unduh silabus, modul pembelajaran, formulir administrasi, dan dokumen lainnya."
                tone="onbrand"
            />
            {{-- Sub-nav portal --}}
            <div style="display:flex;gap:8px;flex-wrap:wrap;margin-top:28px;">
                <a href="{{ route('portal.kalender') }}" class="am-btn am-btn--onbrand am-btn--sm">Kalender</a>
                <a href="{{ route('portal.kurikulum') }}" class="am-btn am-btn--onbrand am-btn--sm">Kurikulum</a>
                <a href="{{ route('portal.pengumuman') }}" class="am-btn am-btn--onbrand am-btn--sm">Pengumuman</a>
                <a href="{{ route('portal.download') }}" class="am-btn am-btn--secondary am-btn--sm">Download</a>
            </div>
        </div>
    </section>

    <section class="am-section" style="background:var(--cream-50);">
        <div class="am-container">

            {{-- Filters --}}
            <div style="display:flex;gap:24px;flex-wrap:wrap;margin-bottom:36px;">
                {{-- Jenjang --}}
                @php $jenjangFilters = ['' => 'Semua Jenjang', 'sdit' => 'SDIT AL MANAR', 'tkit' => 'TKIT AL MANAR']; @endphp
                <div style="display:flex;gap:8px;flex-wrap:wrap;">
                    @foreach($jenjangFilters as $key => $label)
                        @php $isActive = $key === '' ? is_null($jenjang) : $jenjang === $key; @endphp
                        <a
                            href="{{ route('portal.download', array_filter(['jenjang' => $key ?: null, 'category' => $category])) }}"
                            class="am-btn am-btn--sm {{ $isActive ? 'am-btn--primary' : 'am-btn--outline' }}"
                        >{{ $label }}</a>
                    @endforeach
                </div>

                {{-- Category --}}
                @if($categories->isNotEmpty())
                    <div style="display:flex;gap:8px;flex-wrap:wrap;">
                        <a
                            href="{{ route('portal.download', array_filter(['jenjang' => $jenjang])) }}"
                            class="am-btn am-btn--sm {{ is_null($category) ? 'am-btn--primary' : 'am-btn--outline' }}"
                        >Semua Kategori</a>
                        @foreach($categories as $cat)
                            @php $catActive = $category === $cat; @endphp
                            <a
                                href="{{ route('portal.download', array_filter(['jenjang' => $jenjang, 'category' => $cat])) }}"
                                class="am-btn am-btn--sm {{ $catActive ? 'am-btn--primary' : 'am-btn--outline' }}"
                            >{{ $cat }}</a>
                        @endforeach
                    </div>
                @endif
            </div>

            @if($downloads->isNotEmpty())
                <div style="background:#fff;border:1px solid var(--border-default);border-radius:var(--radius-xl);overflow:hidden;">
                    @foreach($downloads as $download)
                        <div
                            class="am-reveal"
                            style="display:flex;align-items:center;gap:16px;padding:18px 24px;{{ !$loop->last ? 'border-bottom:1px solid var(--border-subtle);' : '' }}"
                        >
                            {{-- Icon --}}
                            <div style="width:44px;height:44px;background:var(--cream-100);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            </div>

                            {{-- Info --}}
                            <div style="flex:1;min-width:0;">
                                <div style="font-family:var(--font-sans);font-weight:600;font-size:var(--text-sm);color:var(--ink-900);margin-bottom:5px;">
                                    {{ $download->title }}
                                </div>
                                <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
                                    @if($download->original_filename)
                                        <span style="font-family:var(--font-sans);font-size:var(--text-xs);color:var(--ink-400);">{{ $download->original_filename }}</span>
                                    @endif
                                    @if($download->school)
                                        <x-badge
                                            :tone="$download->school->level === 'sdit' ? 'sdit' : 'tkit'"
                                            variant="soft"
                                            size="sm"
                                        >{{ $download->school->level === 'sdit' ? 'SDIT' : 'TKIT' }}</x-badge>
                                    @endif
                                    @if($download->category)
                                        <x-badge tone="cream" variant="soft" size="sm">{{ $download->category }}</x-badge>
                                    @endif
                                </div>
                            </div>

                            {{-- Download button --}}
                            @if($download->file_path)
                                <a
                                    href="{{ Storage::url($download->file_path) }}"
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

                <div style="margin-top:32px;">
                    {{ $downloads->links() }}
                </div>
            @else
                <div style="text-align:center;padding:80px 20px;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--green-300)" stroke-width="1.5" style="display:block;margin:0 auto 16px;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--ink-400);margin:0;">
                        Belum ada dokumen yang tersedia@if($jenjang || $category) untuk filter ini@endif.
                    </p>
                    @if($jenjang || $category)
                        <a href="{{ route('portal.download') }}" class="am-btn am-btn--outline am-btn--sm" style="margin-top:16px;display:inline-flex;">
                            Lihat semua dokumen
                        </a>
                    @endif
                </div>
            @endif

        </div>
    </section>

</x-layouts.app>
