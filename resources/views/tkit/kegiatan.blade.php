<x-layouts.app
    navActive="tkit"
    title="Kegiatan TKIT AL MANAR"
    description="Kegiatan dan dokumentasi siswa TKIT AL MANAR Kota Bekasi."
>

    {{-- ── Page header ─────────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);padding:40px 0 36px;">
        <div class="am-container">
            <nav style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--gold-200);display:flex;align-items:center;gap:8px;margin-bottom:20px;opacity:.8;">
                <a href="{{ route('home') }}" style="color:inherit;text-decoration:none;">Beranda</a>
                <span>/</span>
                <a href="{{ route('tkit.index') }}" style="color:inherit;text-decoration:none;">TKIT AL MANAR</a>
                <span>/</span>
                <span>Kegiatan</span>
            </nav>
            <x-section-header
                eyebrow="TKIT AL MANAR"
                title="Kegiatan Siswa"
                lead="Dokumentasi kegiatan sentra bermain, pembiasaan ibadah, dan momen berharga siswa TKIT AL MANAR."
                tone="onbrand"
            />
        </div>
    </section>

    <section class="am-section" style="background:var(--cream-50);">
        <div class="am-container">

            @if($activities->isNotEmpty())
                <div class="am-grid-3">
                    @foreach($activities as $activity)
                        <div class="am-reveal am-card" style="padding:0;overflow:hidden;transition-delay:{{ ($loop->index % 3) * 70 }}ms;">
                            {{-- Thumbnail --}}
                            <div style="height:220px;overflow:hidden;background:var(--green-100);position:relative;">
                                @if($activity->youtube_id)
                                    <iframe
                                        src="https://www.youtube.com/embed/{{ $activity->youtube_id }}"
                                        title="{{ $activity->title }}"
                                        style="width:100%;height:100%;border:0;display:block;"
                                        loading="lazy"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        allowfullscreen
                                    ></iframe>
                                @elseif($activity->thumbnail_path)
                                    <img
                                        src="{{ Storage::url($activity->thumbnail_path) }}"
                                        alt="{{ $activity->title }}"
                                        style="width:100%;height:100%;object-fit:cover;"
                                        loading="lazy"
                                    >
                                @elseif($activity->photos->isNotEmpty())
                                    <img
                                        src="{{ Storage::url($activity->photos->first()->path) }}"
                                        alt="{{ $activity->title }}"
                                        style="width:100%;height:100%;object-fit:cover;"
                                        loading="lazy"
                                    >
                                @else
                                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--green-300)" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                    </div>
                                @endif

                                @if(! $activity->youtube_id && $activity->photos->count() > 1)
                                    <div style="position:absolute;top:12px;right:12px;">
                                        <span style="background:rgba(0,0,0,.55);border-radius:var(--radius-md);padding:4px 10px;font-family:var(--font-sans);font-size:var(--text-xs);font-weight:600;color:#fff;display:inline-flex;align-items:center;gap:5px;">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                            {{ $activity->photos->count() }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            {{-- Body --}}
                            <div style="padding:20px 22px 24px;display:flex;flex-direction:column;gap:10px;">
                                <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
                                    @if($activity->category)
                                        <span style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;color:var(--gold-600);text-transform:uppercase;letter-spacing:0.06em;">{{ $activity->category }}</span>
                                    @endif
                                    @if($activity->activity_date)
                                        <span style="font-family:var(--font-sans);font-size:var(--text-xs);color:var(--ink-400);display:inline-flex;align-items:center;gap:4px;">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                            {{ \Carbon\Carbon::parse($activity->activity_date)->translatedFormat('d M Y') }}
                                        </span>
                                    @endif
                                </div>

                                <h3 style="font-family:var(--font-display);font-weight:600;font-size:var(--text-lg);line-height:1.3;color:var(--ink-900);margin:0;">
                                    {{ $activity->title }}
                                </h3>

                                @if($activity->description)
                                    <p style="font-family:var(--font-sans);font-size:var(--text-sm);line-height:1.65;color:var(--ink-500);margin:0;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                        {{ strip_tags($activity->description) }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top:48px;">
                    {{ $activities->links() }}
                </div>
            @else
                <div style="text-align:center;padding:80px 20px;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--green-300)" stroke-width="1.5" style="display:block;margin:0 auto 16px;"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--ink-400);margin:0;">
                        Belum ada data kegiatan TKIT.
                    </p>
                </div>
            @endif

        </div>
    </section>

</x-layouts.app>
