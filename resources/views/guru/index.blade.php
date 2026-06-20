<x-layouts.app navActive="guru" title="Tenaga Pendidik" description="Profil guru dan kepala sekolah SDIT dan TKIT AL MANAR Kota Bekasi.">

    {{-- ── Page header ─────────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);padding:40px 0 36px;">
        <div class="am-container">
            <x-section-header
                eyebrow="Tenaga Pendidik"
                title="Guru & Kepala Sekolah AL MANAR"
                lead="Mengenal lebih dekat para pendidik yang membimbing putra-putri Anda."
                tone="onbrand"
            />
        </div>
    </section>

    <section class="am-section" style="background:var(--cream-50);">
        <div class="am-container">

            {{-- Filter jenjang --}}
            @php
                $filters = ['' => 'Semua Jenjang', 'sdit' => 'SDIT AL MANAR', 'tkit' => 'KB Raudhatul Jannah'];
            @endphp
            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:36px;">
                @foreach($filters as $key => $label)
                    @php $isActive = $key === '' ? is_null($jenjang) : $jenjang === $key; @endphp
                    <a
                        href="{{ $key ? route('guru.index', ['jenjang' => $key]) : route('guru.index') }}"
                        class="am-btn am-btn--sm {{ $isActive ? 'am-btn--primary' : 'am-btn--outline' }}"
                    >{{ $label }}</a>
                @endforeach
            </div>

            @if($teachers->isNotEmpty())
                <div class="am-grid-3">
                    @foreach($teachers as $teacher)
                        <div class="am-reveal" style="transition-delay:{{ ($loop->index % 3) * 70 }}ms;">
                            <x-teacher-card
                                :name="$teacher->name"
                                :position="$teacher->position"
                                :photo="$teacher->photo_path ? Storage::url($teacher->photo_path) : null"
                                :bio="$teacher->bio"
                                :isPrincipal="$teacher->is_principal"
                            />
                        </div>
                    @endforeach
                </div>

                <div style="margin-top:48px;">
                    {{ $teachers->links() }}
                </div>
            @else
                <div style="text-align:center;padding:80px 20px;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--green-300)" stroke-width="1.5" style="display:block;margin:0 auto 16px;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--ink-400);margin:0;">
                        Belum ada data tenaga pendidik @if($jenjang) untuk jenjang ini @endif.
                    </p>
                </div>
            @endif
        </div>
    </section>

</x-layouts.app>
