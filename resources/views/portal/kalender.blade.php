<x-layouts.app navActive="portal" title="Kalender Pendidikan" description="Kalender agenda kegiatan SDIT Al Manar dan Kelompok Bermain Raudhatul Athfal Al Manar per bulan.">

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
                lead="Agenda kegiatan bulanan untuk SDIT Al Manar dan Kelompok Bermain Raudhatul Athfal Al Manar."
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
            <livewire:public-calendar />
        </div>
    </section>

</x-layouts.app>
