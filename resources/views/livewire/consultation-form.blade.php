<div>
    @if($submitted)
        {{-- ── Success state ────────────────────────────────────────────────── --}}
        <div style="max-width:480px;margin:0 auto;text-align:center;padding:48px 24px;">
            <div style="width:72px;height:72px;background:var(--success-50);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--success-500)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <h2 style="font-family:var(--font-display);font-size:var(--text-2xl);font-weight:700;color:var(--ink-900);margin:0 0 12px;">Terima Kasih!</h2>
            <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--ink-500);line-height:1.65;margin:0 0 28px;">
                Data Anda sudah kami terima. Lanjutkan percakapan via WhatsApp supaya tim kami bisa langsung bantu — respons biasanya dalam 1x24 jam.
            </p>
            <a href="{{ $waLink }}" target="_blank" rel="noopener noreferrer" class="am-btn am-btn--primary am-btn--lg am-btn--block" style="margin-bottom:12px;">
                Lanjut ke WhatsApp
            </a>
            <a href="{{ route('home') }}" class="am-btn am-btn--outline am-btn--md">Kembali ke Beranda</a>
        </div>
    @else
        {{-- ── Form ─────────────────────────────────────────────────────────── --}}
        <form wire:submit.prevent="submit">
            <div style="display:flex;flex-direction:column;gap:20px;">

                <div class="am-form-group">
                    <label class="am-label am-label--required">Nama Orang Tua/Wali</label>
                    <input wire:model="parent_name" type="text" class="am-input @error('parent_name') am-input--error @enderror" placeholder="Nama lengkap">
                    @error('parent_name') <p class="am-field-error">{{ $message }}</p> @enderror
                </div>

                <div class="am-form-group">
                    <label class="am-label am-label--required">Nomor WhatsApp</label>
                    <input wire:model="whatsapp" type="text" class="am-input @error('whatsapp') am-input--error @enderror" placeholder="0812xxxxxxxx">
                    @error('whatsapp') <p class="am-field-error">{{ $message }}</p> @enderror
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="am-form-group">
                        <label class="am-label">Usia / Kelas Anak</label>
                        <input wire:model="child_info" type="text" class="am-input" placeholder="Contoh: 5 tahun / TK B">
                    </div>
                    <div class="am-form-group">
                        <label class="am-label">Domisili</label>
                        <input wire:model="domicile" type="text" class="am-input" placeholder="Contoh: Wisma Asri">
                    </div>
                </div>

                <div class="am-form-group">
                    <label class="am-label am-label--required">Unit yang Diminati</label>
                    <select wire:model="school_id" class="am-input @error('school_id') am-input--error @enderror">
                        <option value="">Pilih unit</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </select>
                    @error('school_id') <p class="am-field-error">{{ $message }}</p> @enderror
                </div>

                <div class="am-form-group">
                    <label class="am-label am-label--required">Saya Ingin</label>
                    <select wire:model="interest_type" class="am-input @error('interest_type') am-input--error @enderror">
                        <option value="konsultasi">Konsultasi Dulu</option>
                        <option value="brosur">Minta Brosur</option>
                        <option value="kunjungan">Jadwalkan Kunjungan Sekolah</option>
                    </select>
                    @error('interest_type') <p class="am-field-error">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="am-btn am-btn--primary am-btn--lg am-btn--block" wire:loading.attr="disabled" wire:target="submit">
                    <span wire:loading.remove wire:target="submit">Kirim</span>
                    <span wire:loading wire:target="submit">Mengirim...</span>
                </button>
            </div>
        </form>
    @endif
</div>
