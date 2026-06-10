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
                            <li>Fotokopi Sertifikat NPSN dari TK/RA</li>
                            <li>Fotokopi Surat Izin Operasional TK/RA</li>
                            <li>Formulir pendaftaran yang sudah diisi lengkap dan ditandatangani Orang Tua/Wali</li>
                        </ol>
                        <div style="margin-top:14px;padding:12px 16px;background:var(--gold-50, var(--cream-100));border-left:3px solid var(--gold-500, var(--green-400));border-radius:0 6px 6px 0;">
                            <p style="font-family:var(--font-sans);font-size:var(--text-xs);color:var(--ink-600);margin:0;line-height:1.65;">
                                <strong>Usia minimal:</strong> 6 tahun per 1 Juli {{ date('Y') + 1 }} (kelahiran paling lambat 1 Juli {{ date('Y') - 5 }}), bagi yang telah bersekolah di TK — dibuktikan dengan surat keterangan/sertifikat.<br>
                                <strong>Siswa pindahan:</strong> persyaratan tambahan dapat ditanyakan langsung ke Tata Usaha (Administrasi).
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

                        <p style="font-family:var(--font-sans);font-size:var(--text-xs);color:var(--ink-500);margin:0 0 14px;">
                            Biaya Pendaftaran / Formulir: <strong style="color:var(--ink-800);">Rp 250.000</strong>
                        </p>

                        {{-- Gelombang I --}}
                        <div style="margin-bottom:16px;">
                            <div style="display:inline-flex;align-items:center;gap:6px;background:var(--green-600);color:#fff;font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;padding:4px 12px;border-radius:20px;margin-bottom:8px;">
                                Gelombang I — Sept s/d Des 2025
                            </div>
                            <div style="overflow-x:auto;">
                                <table style="width:100%;border-collapse:collapse;font-family:var(--font-sans);font-size:var(--text-xs);">
                                    <thead>
                                        <tr style="background:var(--cream-100);">
                                            <th style="padding:8px 12px;text-align:left;color:var(--ink-600);font-weight:700;border:1px solid var(--sand-200);white-space:nowrap;">Komponen</th>
                                            <th colspan="2" style="padding:8px 12px;text-align:center;color:var(--green-700);font-weight:700;border:1px solid var(--sand-200);">Dari TK ALMANAR</th>
                                            <th colspan="2" style="padding:8px 12px;text-align:center;color:var(--ink-600);font-weight:700;border:1px solid var(--sand-200);">Dari TK Luar / Umum</th>
                                        </tr>
                                        <tr style="background:var(--cream-50);">
                                            <th style="padding:6px 12px;border:1px solid var(--sand-200);"></th>
                                            <th style="padding:6px 12px;text-align:center;color:var(--ink-500);font-weight:600;border:1px solid var(--sand-200);">Putra</th>
                                            <th style="padding:6px 12px;text-align:center;color:var(--ink-500);font-weight:600;border:1px solid var(--sand-200);">Putri</th>
                                            <th style="padding:6px 12px;text-align:center;color:var(--ink-500);font-weight:600;border:1px solid var(--sand-200);">Putra</th>
                                            <th style="padding:6px 12px;text-align:center;color:var(--ink-500);font-weight:600;border:1px solid var(--sand-200);">Putri</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach([
                                            ['Infaq Pendidikan (SPP)', '500.000', '500.000', '500.000', '500.000'],
                                            ['Infaq Bangunan', '6.500.000', '6.500.000', '7.500.000', '7.500.000'],
                                            ['Infaq Kegiatan (KBM)', '2.060.000', '2.060.000', '2.060.000', '2.060.000'],
                                            ['Seragam', '1.200.000', '1.350.000', '1.200.000', '1.350.000'],
                                        ] as [$label, $c1, $c2, $c3, $c4])
                                        <tr>
                                            <td style="padding:8px 12px;color:var(--ink-700);border:1px solid var(--sand-200);white-space:nowrap;">{{ $label }}</td>
                                            <td style="padding:8px 12px;text-align:right;color:var(--ink-700);border:1px solid var(--sand-200);white-space:nowrap;">Rp {{ $c1 }}</td>
                                            <td style="padding:8px 12px;text-align:right;color:var(--ink-700);border:1px solid var(--sand-200);white-space:nowrap;">Rp {{ $c2 }}</td>
                                            <td style="padding:8px 12px;text-align:right;color:var(--ink-700);border:1px solid var(--sand-200);white-space:nowrap;">Rp {{ $c3 }}</td>
                                            <td style="padding:8px 12px;text-align:right;color:var(--ink-700);border:1px solid var(--sand-200);white-space:nowrap;">Rp {{ $c4 }}</td>
                                        </tr>
                                        @endforeach
                                        <tr style="background:var(--green-50);">
                                            <td style="padding:8px 12px;font-weight:700;color:var(--green-800);border:1px solid var(--sand-200);">TOTAL</td>
                                            <td style="padding:8px 12px;text-align:right;font-weight:700;color:var(--green-800);border:1px solid var(--sand-200);white-space:nowrap;">Rp 10.260.000</td>
                                            <td style="padding:8px 12px;text-align:right;font-weight:700;color:var(--green-800);border:1px solid var(--sand-200);white-space:nowrap;">Rp 10.410.000</td>
                                            <td style="padding:8px 12px;text-align:right;font-weight:700;color:var(--green-800);border:1px solid var(--sand-200);white-space:nowrap;">Rp 11.260.000</td>
                                            <td style="padding:8px 12px;text-align:right;font-weight:700;color:var(--green-800);border:1px solid var(--sand-200);white-space:nowrap;">Rp 11.410.000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Gelombang II --}}
                        <div style="margin-bottom:14px;">
                            <div style="display:inline-flex;align-items:center;gap:6px;background:var(--ink-700);color:#fff;font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;padding:4px 12px;border-radius:20px;margin-bottom:8px;">
                                Gelombang II — Jan s/d Apr 2026
                            </div>
                            <div style="overflow-x:auto;">
                                <table style="width:100%;border-collapse:collapse;font-family:var(--font-sans);font-size:var(--text-xs);">
                                    <thead>
                                        <tr style="background:var(--cream-100);">
                                            <th style="padding:8px 12px;text-align:left;color:var(--ink-600);font-weight:700;border:1px solid var(--sand-200);white-space:nowrap;">Komponen</th>
                                            <th colspan="2" style="padding:8px 12px;text-align:center;color:var(--green-700);font-weight:700;border:1px solid var(--sand-200);">Dari TK ALMANAR</th>
                                            <th colspan="2" style="padding:8px 12px;text-align:center;color:var(--ink-600);font-weight:700;border:1px solid var(--sand-200);">Dari TK Luar / Umum</th>
                                        </tr>
                                        <tr style="background:var(--cream-50);">
                                            <th style="padding:6px 12px;border:1px solid var(--sand-200);"></th>
                                            <th style="padding:6px 12px;text-align:center;color:var(--ink-500);font-weight:600;border:1px solid var(--sand-200);">Putra</th>
                                            <th style="padding:6px 12px;text-align:center;color:var(--ink-500);font-weight:600;border:1px solid var(--sand-200);">Putri</th>
                                            <th style="padding:6px 12px;text-align:center;color:var(--ink-500);font-weight:600;border:1px solid var(--sand-200);">Putra</th>
                                            <th style="padding:6px 12px;text-align:center;color:var(--ink-500);font-weight:600;border:1px solid var(--sand-200);">Putri</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach([
                                            ['Infaq Pendidikan (SPP)', '500.000', '500.000', '500.000', '500.000'],
                                            ['Infaq Bangunan', '7.500.000', '7.500.000', '8.500.000', '8.500.000'],
                                            ['Infaq Kegiatan (KBM)', '2.060.000', '2.060.000', '2.060.000', '2.060.000'],
                                            ['Seragam', '1.200.000', '1.350.000', '1.200.000', '1.350.000'],
                                        ] as [$label, $c1, $c2, $c3, $c4])
                                        <tr>
                                            <td style="padding:8px 12px;color:var(--ink-700);border:1px solid var(--sand-200);white-space:nowrap;">{{ $label }}</td>
                                            <td style="padding:8px 12px;text-align:right;color:var(--ink-700);border:1px solid var(--sand-200);white-space:nowrap;">Rp {{ $c1 }}</td>
                                            <td style="padding:8px 12px;text-align:right;color:var(--ink-700);border:1px solid var(--sand-200);white-space:nowrap;">Rp {{ $c2 }}</td>
                                            <td style="padding:8px 12px;text-align:right;color:var(--ink-700);border:1px solid var(--sand-200);white-space:nowrap;">Rp {{ $c3 }}</td>
                                            <td style="padding:8px 12px;text-align:right;color:var(--ink-700);border:1px solid var(--sand-200);white-space:nowrap;">Rp {{ $c4 }}</td>
                                        </tr>
                                        @endforeach
                                        <tr style="background:var(--green-50);">
                                            <td style="padding:8px 12px;font-weight:700;color:var(--green-800);border:1px solid var(--sand-200);">TOTAL</td>
                                            <td style="padding:8px 12px;text-align:right;font-weight:700;color:var(--green-800);border:1px solid var(--sand-200);white-space:nowrap;">Rp 11.260.000</td>
                                            <td style="padding:8px 12px;text-align:right;font-weight:700;color:var(--green-800);border:1px solid var(--sand-200);white-space:nowrap;">Rp 11.410.000</td>
                                            <td style="padding:8px 12px;text-align:right;font-weight:700;color:var(--green-800);border:1px solid var(--sand-200);white-space:nowrap;">Rp 12.260.000</td>
                                            <td style="padding:8px 12px;text-align:right;font-weight:700;color:var(--green-800);border:1px solid var(--sand-200);white-space:nowrap;">Rp 12.410.000</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <p style="font-family:var(--font-sans);font-size:var(--text-xs);color:var(--ink-400);margin:0;line-height:1.65;">
                            * Anak dengan ukuran seragam &gt; XXXL dikenakan biaya tambahan <strong>Rp 200.000</strong>.<br>
                            * Infaq Pendidikan sudah termasuk: seragam 5 stel, buku paket 1 tahun, raport, asuransi, kalender, dan biaya kegiatan siswa.
                        </p>
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
                            <p style="font-weight:700;color:var(--ink-800);margin:0 0 6px;">Pembayaran Uang Muka</p>
                            <ul style="margin:0 0 14px;padding-left:20px;">
                                <li>Dari TK ALMANAR: uang muka <strong>Rp 4.000.000</strong> saat mengembalikan formulir pendaftaran</li>
                                <li>Dari TK Luar/Umum: uang muka <strong>Rp 5.000.000</strong> saat mengembalikan formulir pendaftaran</li>
                                <li>Pembayaran SPP keseluruhan 1 tahun mendapatkan potongan <strong>5%</strong></li>
                            </ul>
                            <p style="font-weight:700;color:var(--ink-800);margin:0 0 6px;">Setelah Pengumuman</p>
                            <ul style="margin:0 0 14px;padding-left:20px;">
                                <li>Calon siswa <strong>diterima</strong>: infaq biaya sekolah dilunasi saat Daftar Ulang (Juli {{ date('Y') + 1 }})</li>
                                <li>Calon siswa <strong>tidak diterima</strong>: uang muka dikembalikan penuh (kecuali biaya formulir)</li>
                            </ul>
                            <p style="font-weight:700;color:var(--ink-800);margin:0 0 6px;">Ketentuan Lain</p>
                            <ul style="margin:0;padding-left:20px;">
                                <li>Mengundurkan diri dikenakan potongan <strong>15%</strong> dari Infaq Bangunan</li>
                                <li>Tidak melaksanakan Daftar Ulang sesuai jadwal dianggap mengundurkan diri dan dikenakan potongan <strong>15%</strong> dari Infaq Bangunan — tempat diberikan kepada calon siswa cadangan</li>
                                <li>Menerima <strong>3 kelas (rombel) @ 28 siswa</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Livewire form --}}
            <div style="background:var(--surface-card);border:var(--border-card);border-radius:var(--radius-xl);padding:40px 44px;box-shadow:var(--shadow-sm);">
                <livewire:registration-form school="sdit" />
            </div>

        </div>
    </section>

</x-layouts.app>
