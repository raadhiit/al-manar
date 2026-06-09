<footer style="background:var(--green-900);color:var(--text-on-brand);">
    <div class="am-container am-foot-grid" style="padding-top:56px;">
        {{-- Brand block --}}
        <div style="display:flex;flex-direction:column;gap:18px;max-width:320px;">
            <a href="{{ route('home') }}" style="text-decoration:none;">
                <x-logo tone="light" :size="44" subtitle="Yayasan · Kota Bekasi" />
            </a>
            <p style="font-size:var(--text-sm);color:var(--gold-100);opacity:.8;line-height:1.7;">
                Lembaga pendidikan Islam terpadu yang membentuk generasi berakhlak mulia, berprestasi, dan cinta Al-Qur'an di Kota Bekasi.
            </p>
            <div style="display:flex;gap:10px;">
                {{-- Instagram --}}
                <a href="#" aria-label="Instagram" style="width:38px;height:38px;border-radius:50%;border:1px solid rgba(217,171,61,0.4);display:inline-flex;align-items:center;justify-content:center;color:var(--gold-300);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="5"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
                </a>
                {{-- Facebook --}}
                <a href="#" aria-label="Facebook" style="width:38px;height:38px;border-radius:50%;border:1px solid rgba(217,171,61,0.4);display:inline-flex;align-items:center;justify-content:center;color:var(--gold-300);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                </a>
                {{-- YouTube --}}
                <a href="#" aria-label="YouTube" style="width:38px;height:38px;border-radius:50%;border:1px solid rgba(217,171,61,0.4);display:inline-flex;align-items:center;justify-content:center;color:var(--gold-300);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 0 0 1.46 6.42C1 8.14 1 11.75 1 11.75s0 3.61.46 5.33a2.78 2.78 0 0 0 1.95 1.96C5.12 19.5 12 19.5 12 19.5s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.96C23 15.36 23 11.75 23 11.75s0-3.61-.46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02" fill="currentColor" stroke="none"/></svg>
                </a>
            </div>
        </div>

        {{-- Link columns --}}
        @php
        $cols = [
            ['title' => 'Sekolah', 'links' => [
                ['label' => 'SDIT AL MANAR',      'href' => route('sdit.index')],
                ['label' => 'TKIT AL MANAR',      'href' => route('tkit.index')],
                ['label' => 'Visi & Misi',        'href' => route('sdit.index')],
                ['label' => 'Struktur Organisasi','href' => route('sdit.index')],
            ]],
            ['title' => 'Informasi', 'links' => [
                ['label' => 'Berita',           'href' => route('berita.index')],
                ['label' => 'Prestasi',         'href' => route('prestasi.index')],
                ['label' => 'Galeri',           'href' => route('galeri.index')],
                ['label' => 'Portal Akademik',  'href' => route('portal.kalender')],
            ]],
            ['title' => 'PPDB', 'links' => [
                ['label' => 'Pendaftaran SDIT', 'href' => route('sdit.pendaftaran')],
                ['label' => 'Pendaftaran TKIT', 'href' => route('tkit.pendaftaran')],
                ['label' => 'Kontak',           'href' => route('kontak')],
            ]],
        ];
        @endphp

        @foreach($cols as $col)
            <div style="display:flex;flex-direction:column;gap:14px;">
                <h4 style="font-family:var(--font-sans);font-size:var(--text-sm);font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:var(--gold-300);margin:0;">
                    {{ $col['title'] }}
                </h4>
                <ul style="list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:10px;">
                    @foreach($col['links'] as $link)
                        <li>
                            <a href="{{ $link['href'] }}" style="color:var(--gold-100);opacity:.78;font-size:var(--text-sm);text-decoration:none;">
                                {{ $link['label'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>

    {{-- Copyright strip --}}
    <div class="am-container" style="margin-top:40px;padding-top:20px;padding-bottom:20px;border-top:1px solid rgba(217,171,61,0.22);display:flex;justify-content:space-between;flex-wrap:wrap;gap:12px;font-size:var(--text-xs);color:var(--gold-100);opacity:.7;">
        <span>© {{ date('Y') }} Yayasan AL MANAR Kota Bekasi. Hak cipta dilindungi.</span>
        <span style="display:inline-flex;gap:18px;">
            <a href="#" style="color:inherit;">Kebijakan Privasi</a>
            <a href="#" style="color:inherit;">Syarat &amp; Ketentuan</a>
        </span>
    </div>
</footer>
