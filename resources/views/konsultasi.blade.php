<x-layouts.app navActive="konsultasi" title="Konsultasi PPDB" description="Isi form singkat untuk konsultasi, minta brosur, atau jadwalkan kunjungan ke SDIT Al Manar dan Kelompok Bermain Raudhatul Athfal Al Manar — tanpa perlu isi data lengkap dulu.">

    {{-- ── Page header ─────────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);position:relative;overflow:hidden;padding:40px 0 36px;">
        <div style="position:absolute;inset:0;background-image:var(--pattern-girih);opacity:.3;" aria-hidden="true"></div>
        <div class="am-container" style="position:relative;">
            <x-section-header
                eyebrow="Sebelum Daftar"
                title="Konsultasi PPDB Dulu, Yuk"
                lead="Belum siap isi formulir lengkap? Isi form singkat ini — tim kami yang lanjut hubungi Anda via WhatsApp."
                tone="onbrand"
            />
        </div>
    </section>

    <section class="am-section" style="background:var(--cream-50);padding-top:40px;">
        <div class="am-container" style="max-width:560px;">
            <div style="background:var(--surface-card);border:var(--border-card);border-radius:var(--radius-xl);padding:40px 44px;box-shadow:var(--shadow-sm);">
                <livewire:consultation-form />
            </div>
        </div>
    </section>

</x-layouts.app>
