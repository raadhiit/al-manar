<x-layouts.app navActive="sdit" title="Pendaftaran SDIT" description="Formulir pendaftaran PPDB SDIT AL MANAR Kota Bekasi. Daftarkan putra-putri Anda secara online.">

    {{-- ── Page header ─────────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);position:relative;overflow:hidden;padding:40px 0 36px;">
        <div style="position:absolute;inset:0;background-image:var(--pattern-girih);opacity:.3;" aria-hidden="true"></div>
        <div class="am-container" style="position:relative;">
            <x-section-header
                eyebrow="PPDB {{ date('Y') }}/{{ date('Y') + 1 }}"
                title="Pendaftaran SDIT AL MANAR"
                lead="Isi formulir di bawah ini untuk mendaftarkan putra-putri Anda. Proses mudah, cepat, dan bisa dari rumah."
                tone="onbrand"
            />
        </div>
    </section>

    <section class="am-section" style="background:var(--cream-50);">
        <div class="am-container" style="max-width:720px;">

            {{-- Info card --}}
            <div style="background:var(--info-50);border:1px solid #BDD5EE;border-radius:var(--radius-md);padding:16px 20px;margin-bottom:32px;display:flex;gap:14px;align-items:flex-start;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--info-500)" stroke-width="2" stroke-linecap="round" style="flex-shrink:0;margin-top:1px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <div style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--info-500);line-height:1.65;">
                    <strong>Informasi Pendaftaran SDIT</strong> — Usia calon siswa minimal 6 tahun per 1 Juli {{ date('Y') }}.
                    Setelah submit, tim kami akan menghubungi via <strong>WhatsApp</strong> dalam 1–3 hari kerja.
                </div>
            </div>

            {{-- Livewire form --}}
            <div style="background:var(--surface-card);border:var(--border-card);border-radius:var(--radius-xl);padding:40px 44px;box-shadow:var(--shadow-sm);">
                <livewire:registration-form school="sdit" />
            </div>

        </div>
    </section>

</x-layouts.app>
