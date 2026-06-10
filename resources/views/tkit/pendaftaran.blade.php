<x-layouts.app navActive="tkit" title="Pendaftaran TKIT" description="Formulir pendaftaran PPDB TKIT AL MANAR Kota Bekasi. Daftarkan putra-putri Anda secara online.">

    {{-- ── Page header ─────────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);position:relative;overflow:hidden;padding:40px 0 36px;">
        <div style="position:absolute;inset:0;background-image:var(--pattern-girih);opacity:.3;" aria-hidden="true"></div>
        <div class="am-container" style="position:relative;">
            <x-section-header
                eyebrow="PPDB {{ date('Y') }}/{{ date('Y') + 1 }}"
                title="Pendaftaran TKIT AL MANAR"
                lead="Isi formulir di bawah ini untuk mendaftarkan putra-putri Anda. Proses mudah, cepat, dan bisa dari rumah."
                tone="onbrand"
            />
        </div>
    </section>

    <section class="am-section" style="background:var(--cream-50);padding-top:40px;">
        <div class="am-container" style="max-width:720px;">

            {{-- ── Info Accordion ──────────────────────────────────────── --}}
            <div x-data="{ open: null }" style="margin-bottom:28px;border:var(--border-card);border-radius:var(--radius-xl);background:var(--surface-card);overflow:hidden;box-shadow:var(--shadow-sm);">

                {{-- Accordion title bar --}}
                <div style="padding:18px 28px;border-bottom:1px solid var(--sand-200);display:flex;align-items:center;gap:12px;">
                    <div style="width:36px;height:36px;background:var(--green-100);border-radius:8px;display:flex;align-items:center;justify-content:center;flex:0 0 36px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green-700)" stroke-width="2.5" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                    <div>
                        <div style="font-family:var(--font-display);font-size:var(--text-base);font-weight:700;color:var(--ink-900);">Informasi PPDB {{ date('Y') }}/{{ date('Y') + 1 }}</div>
                        <div style="font-family:var(--font-sans);font-size:var(--text-xs);color:var(--ink-400);margin-top:2px;">Baca sebelum mengisi formulir pendaftaran</div>
                    </div>
                </div>

                {{-- Item 1: Syarat Pendaftaran --}}
                <div style="border-bottom:1px solid var(--sand-200);">
                    <button @click="open = open === 1 ? null : 1" type="button"
                        style="width:100%;display:flex;align-items:center;justify-content:space-between;padding:16px 28px;background:none;border:none;cursor:pointer;text-align:left;gap:16px;">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:28px;height:28px;background:var(--green-50);border-radius:6px;display:flex;align-items:center;justify-content:center;flex:0 0 28px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2.5" stroke-linecap="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
                            </div>
                            <span style="font-family:var(--font-sans);font-size:var(--text-sm);font-weight:700;color:var(--ink-800);">Syarat Pendaftaran</span>
                        </div>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--ink-400)" stroke-width="2.5" stroke-linecap="round" style="flex-shrink:0;transition:transform .2s;" :style="open === 1 ? 'transform:rotate(180deg)' : ''"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div x-show="open === 1" x-cloak style="padding:0 28px 20px;">
                        <ol style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);line-height:1.8;margin:0;padding-left:20px;">
                            <li>Fotokopi Akta Kelahiran siswa</li>
                            <li>Fotokopi Kartu Keluarga (KK) terbaru</li>
                            <li>Fotokopi KTP Ayah dan Ibu terbaru</li>
                            <li>Formulir pendaftaran yang sudah diisi lengkap dan ditandatangani Orang Tua/Wali</li>
                            <li>Pas foto terbaru calon siswa (ukuran 3×4, background polos)</li>
                        </ol>
                        <div style="margin-top:14px;padding:12px 16px;background:var(--cream-100);border-left:3px solid var(--green-400);border-radius:0 6px 6px 0;">
                            <p style="font-family:var(--font-sans);font-size:var(--text-xs);color:var(--ink-600);margin:0;line-height:1.65;">
                                <strong>Usia:</strong> 4–6 tahun per 1 Juli {{ date('Y') + 1 }}.<br>
                                Untuk informasi lebih lanjut, silakan hubungi Tata Usaha TKIT AL MANAR.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Item 2: Rincian Biaya --}}
                <div style="border-bottom:1px solid var(--sand-200);">
                    <button @click="open = open === 2 ? null : 2" type="button"
                        style="width:100%;display:flex;align-items:center;justify-content:space-between;padding:16px 28px;background:none;border:none;cursor:pointer;text-align:left;gap:16px;">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:28px;height:28px;background:var(--green-50);border-radius:6px;display:flex;align-items:center;justify-content:center;flex:0 0 28px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2.5" stroke-linecap="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg>
                            </div>
                            <span style="font-family:var(--font-sans);font-size:var(--text-sm);font-weight:700;color:var(--ink-800);">Rincian Biaya</span>
                        </div>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--ink-400)" stroke-width="2.5" stroke-linecap="round" style="flex-shrink:0;transition:transform .2s;" :style="open === 2 ? 'transform:rotate(180deg)' : ''"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div x-show="open === 2" x-cloak style="padding:0 28px 20px;">
                        <div style="display:flex;gap:14px;align-items:flex-start;padding:16px;background:var(--info-50);border:1px solid #BDD5EE;border-radius:var(--radius-md);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--info-500)" stroke-width="2" stroke-linecap="round" style="flex-shrink:0;margin-top:1px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            <div style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--info-500);line-height:1.65;">
                                Untuk informasi rincian biaya TKIT AL MANAR, silakan hubungi kami melalui
                                <strong>WhatsApp <a href="https://wa.me/6281219443996" target="_blank" style="color:var(--info-500);">0812-1944-3996</a></strong>
                                atau datang langsung ke kantor Tata Usaha TKIT AL MANAR.
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Item 3: Ketentuan & Pembayaran --}}
                <div>
                    <button @click="open = open === 3 ? null : 3" type="button"
                        style="width:100%;display:flex;align-items:center;justify-content:space-between;padding:16px 28px;background:none;border:none;cursor:pointer;text-align:left;gap:16px;">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:28px;height:28px;background:var(--green-50);border-radius:6px;display:flex;align-items:center;justify-content:center;flex:0 0 28px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2.5" stroke-linecap="round"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                            </div>
                            <span style="font-family:var(--font-sans);font-size:var(--text-sm);font-weight:700;color:var(--ink-800);">Ketentuan & Pembayaran</span>
                        </div>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--ink-400)" stroke-width="2.5" stroke-linecap="round" style="flex-shrink:0;transition:transform .2s;" :style="open === 3 ? 'transform:rotate(180deg)' : ''"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div x-show="open === 3" x-cloak style="padding:0 28px 20px;">
                        <div style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);line-height:1.8;">
                            <ul style="margin:0 0 14px;padding-left:20px;">
                                <li>Calon siswa <strong>diterima</strong>: infaq biaya sekolah dilunasi saat Daftar Ulang (Juli {{ date('Y') + 1 }})</li>
                                <li>Calon siswa <strong>tidak diterima</strong>: uang muka dikembalikan penuh (kecuali biaya formulir)</li>
                                <li>Setelah submit formulir online, tim kami akan menghubungi via <strong>WhatsApp</strong> dalam 1–3 hari kerja</li>
                            </ul>
                            <p style="font-family:var(--font-sans);font-size:var(--text-xs);color:var(--ink-400);margin:0;">
                                Untuk ketentuan lengkap, silakan hubungi Tata Usaha TKIT AL MANAR.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Livewire form --}}
            <div style="background:var(--surface-card);border:var(--border-card);border-radius:var(--radius-xl);padding:40px 44px;box-shadow:var(--shadow-sm);">
                <livewire:registration-form school="tkit" />
            </div>

        </div>
    </section>

</x-layouts.app>
