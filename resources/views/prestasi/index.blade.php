<x-layouts.app navActive="prestasi" title="Prestasi" description="Prestasi siswa SDIT dan TKIT AL MANAR — juara lomba dan kompetisi dari tingkat kecamatan hingga nasional.">

    {{-- ── Page header ─────────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);padding:40px 0 36px;">
        <div class="am-container">
            <x-section-header
                eyebrow="Capaian Siswa"
                title="Prestasi AL MANAR"
                lead="Bangga dengan setiap pencapaian siswa kami di berbagai bidang kompetisi."
                tone="onbrand"
            />
        </div>
    </section>

    <section class="am-section" style="background:var(--cream-50);">
        <div class="am-container">

            {{-- Filter jenjang --}}
            @php
                $filters = ['' => 'Semua Jenjang', 'sdit' => 'SDIT AL MANAR', 'tkit' => 'TKIT AL MANAR'];
                $levelLabels = [
                    'kecamatan'     => 'Kecamatan',
                    'kota'          => 'Kota/Kabupaten',
                    'provinsi'      => 'Provinsi',
                    'nasional'      => 'Nasional',
                    'internasional' => 'Internasional',
                ];
            @endphp
            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:36px;">
                @foreach($filters as $key => $label)
                    @php $isActive = $key === '' ? is_null($jenjang) : $jenjang === $key; @endphp
                    <a
                        href="{{ $key ? route('prestasi.index', ['jenjang' => $key]) : route('prestasi.index') }}"
                        class="am-btn am-btn--sm {{ $isActive ? 'am-btn--primary' : 'am-btn--outline' }}"
                    >{{ $label }}</a>
                @endforeach
            </div>

            @if($achievements->isNotEmpty())
                <div class="am-grid-3">
                    @foreach($achievements as $achievement)
                        <div class="am-reveal am-card" style="padding:0;overflow:hidden;transition-delay:{{ ($loop->index % 3) * 70 }}ms;">
                            {{-- Photo --}}
                            <div style="height:200px;overflow:hidden;background:var(--green-100);position:relative;">
                                @if($achievement->photo_path)
                                    <img
                                        src="{{ Storage::url($achievement->photo_path) }}"
                                        alt="{{ $achievement->title }}"
                                        style="width:100%;height:100%;object-fit:cover;"
                                        loading="lazy"
                                    >
                                @else
                                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--green-300)" stroke-width="1"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                    </div>
                                @endif
                                {{-- Rank badge --}}
                                <div style="position:absolute;top:12px;left:12px;">
                                    <x-badge tone="gold" variant="solid" size="md">{{ $achievement->rank }}</x-badge>
                                </div>
                            </div>

                            {{-- Body --}}
                            <div style="padding:20px 22px 24px;display:flex;flex-direction:column;gap:10px;">
                                {{-- Badges --}}
                                <div style="display:flex;gap:8px;flex-wrap:wrap;">
                                    @if($achievement->school)
                                        <x-badge
                                            :tone="$achievement->school->level === 'sdit' ? 'sdit' : 'tkit'"
                                            variant="soft"
                                            size="sm"
                                        >{{ $achievement->school->level === 'sdit' ? 'SDIT' : 'TKIT' }}</x-badge>
                                    @endif
                                    @if($achievement->level)
                                        <x-badge tone="cream" variant="soft" size="sm">
                                            {{ $levelLabels[$achievement->level] ?? Str::title($achievement->level) }}
                                        </x-badge>
                                    @endif
                                </div>

                                {{-- Title --}}
                                <h3 style="font-family:var(--font-display);font-weight:600;font-size:var(--text-base);line-height:1.35;color:var(--ink-900);margin:0;">
                                    {{ $achievement->title }}
                                </h3>

                                {{-- Competition --}}
                                <p style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-500);margin:0;">
                                    {{ $achievement->competition_name }}
                                </p>

                                {{-- Student + year --}}
                                <div style="display:flex;justify-content:space-between;align-items:center;font-family:var(--font-sans);font-size:var(--text-xs);color:var(--ink-400);border-top:1px solid var(--border-subtle);padding-top:10px;margin-top:2px;">
                                    <span>{{ $achievement->student_name ?? '—' }}</span>
                                    <span>{{ $achievement->year }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top:48px;">
                    {{ $achievements->links() }}
                </div>
            @else
                <div style="text-align:center;padding:80px 20px;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--green-300)" stroke-width="1.5" style="display:block;margin:0 auto 16px;"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--ink-400);margin:0;">
                        Belum ada data prestasi@if($jenjang) untuk jenjang ini@endif.
                    </p>
                </div>
            @endif
        </div>
    </section>

</x-layouts.app>
