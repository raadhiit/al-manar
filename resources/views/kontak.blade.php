<x-layouts.app navActive="kontak" title="Kontak" description="Hubungi Yayasan AL MANAR Kota Bekasi — SDIT dan TKIT AL MANAR.">

    {{-- ── Page header ─────────────────────────────────────────────────── --}}
    <section style="background:var(--green-800);padding:40px 0 36px;">
        <div class="am-container">
            <x-section-header
                eyebrow="Hubungi Kami"
                title="Kontak & Lokasi"
                lead="Kami siap menjawab pertanyaan Anda seputar pendaftaran dan informasi sekolah."
                tone="onbrand"
            />
        </div>
    </section>

    <section class="am-section" style="background:var(--cream-50);">
        <div class="am-container">
            <div class="am-grid-2" style="gap:28px;">

                {{-- ── SDIT ── --}}
                <div class="am-card" style="padding:32px;">
                    <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px;">
                        @if($sdit?->logo_path)
                            <img src="{{ Storage::url($sdit->logo_path) }}" alt="{{ $sdit->name }}" style="width:52px;height:52px;object-fit:contain;border-radius:var(--radius-md);">
                        @else
                            <div style="width:52px;height:52px;background:var(--green-100);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                            </div>
                        @endif
                        <div>
                            <div style="font-family:var(--font-display);font-weight:700;font-size:var(--text-lg);color:var(--ink-900);">
                                {{ $sdit?->name ?? 'SDIT AL MANAR' }}
                            </div>
                            <x-badge tone="sdit" variant="soft" size="sm">SDIT</x-badge>
                        </div>
                    </div>

                    <div style="display:flex;flex-direction:column;gap:16px;">
                        @if($sdit?->address)
                            <div style="display:flex;gap:12px;align-items:flex-start;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <div>
                                    <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--ink-400);margin-bottom:3px;">Alamat</div>
                                    <div style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);line-height:1.6;">{{ $sdit->address }}</div>
                                    <a href="https://maps.google.com/?q={{ urlencode($sdit->address) }}" target="_blank" rel="noopener" style="font-family:var(--font-sans);font-size:var(--text-xs);color:var(--green-600);text-decoration:none;font-weight:600;margin-top:4px;display:inline-block;">
                                        Lihat di Google Maps →
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if($sdit?->phone)
                            <div style="display:flex;gap:12px;align-items:center;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2" style="flex-shrink:0;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.63 3.45 2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.5a16 16 0 0 0 5.59 5.59l.97-.97a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7a2 2 0 0 1 1.72 2.03z"/></svg>
                                <div>
                                    <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--ink-400);margin-bottom:3px;">Telepon</div>
                                    <a href="tel:{{ preg_replace('/\D/', '', $sdit->phone) }}" style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);text-decoration:none;">{{ $sdit->phone }}</a>
                                </div>
                            </div>
                        @endif

                        @if($sdit?->email)
                            <div style="display:flex;gap:12px;align-items:center;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2" style="flex-shrink:0;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                <div>
                                    <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--ink-400);margin-bottom:3px;">Email</div>
                                    <a href="mailto:{{ $sdit->email }}" style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);text-decoration:none;">{{ $sdit->email }}</a>
                                </div>
                            </div>
                        @endif

                        @if($sdit?->principal_name)
                            <div style="display:flex;gap:12px;align-items:center;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2" style="flex-shrink:0;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                <div>
                                    <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--ink-400);margin-bottom:3px;">Kepala Sekolah</div>
                                    <div style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);">{{ $sdit->principal_name }}</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div style="margin-top:24px;">
                        <a href="{{ route('sdit.pendaftaran') }}" class="am-btn am-btn--primary am-btn--sm">
                            Daftar SDIT AL MANAR
                        </a>
                    </div>
                </div>

                {{-- ── TKIT ── --}}
                <div class="am-card" style="padding:32px;">
                    <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px;">
                        @if($tkit?->logo_path)
                            <img src="{{ Storage::url($tkit->logo_path) }}" alt="{{ $tkit->name }}" style="width:52px;height:52px;object-fit:contain;border-radius:var(--radius-md);">
                        @else
                            <div style="width:52px;height:52px;background:var(--green-100);border-radius:var(--radius-md);display:flex;align-items:center;justify-content:center;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                            </div>
                        @endif
                        <div>
                            <div style="font-family:var(--font-display);font-weight:700;font-size:var(--text-lg);color:var(--ink-900);">
                                {{ $tkit?->name ?? 'TKIT AL MANAR' }}
                            </div>
                            <x-badge tone="tkit" variant="soft" size="sm">TKIT</x-badge>
                        </div>
                    </div>

                    <div style="display:flex;flex-direction:column;gap:16px;">
                        @if($tkit?->address)
                            <div style="display:flex;gap:12px;align-items:flex-start;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2" style="flex-shrink:0;margin-top:2px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <div>
                                    <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--ink-400);margin-bottom:3px;">Alamat</div>
                                    <div style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);line-height:1.6;">{{ $tkit->address }}</div>
                                    <a href="https://maps.google.com/?q={{ urlencode($tkit->address) }}" target="_blank" rel="noopener" style="font-family:var(--font-sans);font-size:var(--text-xs);color:var(--green-600);text-decoration:none;font-weight:600;margin-top:4px;display:inline-block;">
                                        Lihat di Google Maps →
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if($tkit?->phone)
                            <div style="display:flex;gap:12px;align-items:center;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2" style="flex-shrink:0;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.63 3.45 2 2 0 0 1 3.6 1.27h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.5a16 16 0 0 0 5.59 5.59l.97-.97a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7a2 2 0 0 1 1.72 2.03z"/></svg>
                                <div>
                                    <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--ink-400);margin-bottom:3px;">Telepon</div>
                                    <a href="tel:{{ preg_replace('/\D/', '', $tkit->phone) }}" style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);text-decoration:none;">{{ $tkit->phone }}</a>
                                </div>
                            </div>
                        @endif

                        @if($tkit?->email)
                            <div style="display:flex;gap:12px;align-items:center;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2" style="flex-shrink:0;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                <div>
                                    <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--ink-400);margin-bottom:3px;">Email</div>
                                    <a href="mailto:{{ $tkit->email }}" style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);text-decoration:none;">{{ $tkit->email }}</a>
                                </div>
                            </div>
                        @endif

                        @if($tkit?->principal_name)
                            <div style="display:flex;gap:12px;align-items:center;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--green-600)" stroke-width="2" style="flex-shrink:0;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                <div>
                                    <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:var(--ink-400);margin-bottom:3px;">Kepala Sekolah</div>
                                    <div style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);">{{ $tkit->principal_name }}</div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div style="margin-top:24px;">
                        <a href="{{ route('tkit.pendaftaran') }}" class="am-btn am-btn--primary am-btn--sm">
                            Daftar TKIT AL MANAR
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── CTA PPDB ─────────────────────────────────────────────────────── --}}
    <section class="am-section" style="background:var(--cream-100);border-top:1px solid var(--border-subtle);">
        <div class="am-container" style="text-align:center;display:flex;flex-direction:column;align-items:center;gap:16px;">
            <span class="am-eyebrow">Informasi PPDB</span>
            <h2 style="font-family:var(--font-display);font-weight:700;font-size:var(--text-3xl);color:var(--ink-900);margin:0;max-width:560px;line-height:1.2;">
                Tertarik mendaftarkan putra-putri Anda?
            </h2>
            <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--ink-500);margin:0;max-width:480px;line-height:1.65;">
                Hubungi kami langsung atau klik tombol di bawah untuk memulai proses pendaftaran online.
            </p>
            <div style="display:flex;gap:14px;flex-wrap:wrap;justify-content:center;margin-top:8px;">
                <a href="{{ route('sdit.pendaftaran') }}" class="am-btn am-btn--primary am-btn--lg">Daftar SDIT</a>
                <a href="{{ route('tkit.pendaftaran') }}" class="am-btn am-btn--outline am-btn--lg">Daftar TKIT</a>
            </div>
        </div>
    </section>

</x-layouts.app>
