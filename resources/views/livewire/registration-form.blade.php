<div>
    {{-- ── Selesai / Success state ──────────────────────────────────────── --}}
    @if($submitted)
        <div style="max-width:560px;margin:0 auto;text-align:center;padding:48px 24px;">
            <div style="width:72px;height:72px;background:var(--success-50);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--success-500)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <h2 style="font-family:var(--font-display);font-size:var(--text-2xl);font-weight:700;color:var(--ink-900);margin:0 0 12px;">Pendaftaran Berhasil!</h2>
            <p style="font-family:var(--font-sans);font-size:var(--text-md);color:var(--ink-500);line-height:1.65;margin:0 0 28px;">
                Formulir pendaftaran telah diterima. Tim kami akan menghubungi Anda via WhatsApp dalam 1–3 hari kerja.
            </p>

            <div style="background:var(--cream-100);border:2px dashed var(--sand-400);border-radius:var(--radius-lg);padding:20px 28px;margin-bottom:28px;">
                <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:var(--ink-400);margin-bottom:8px;">Nomor Pendaftaran</div>
                <div style="font-family:var(--font-display);font-size:var(--text-2xl);font-weight:700;color:var(--green-700);letter-spacing:0.04em;">{{ $registrationNumber }}</div>
            </div>

            <p style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-400);margin:0 0 28px;">
                @if($email)
                    Email konfirmasi telah dikirim ke <strong>{{ $email }}</strong>.
                @else
                    Simpan nomor pendaftaran ini untuk memantau status.
                @endif
            </p>

            <a href="{{ route('home') }}" class="am-btn am-btn--outline am-btn--md">Kembali ke Beranda</a>
        </div>

    @else
        {{-- ── Step indicator ──────────────────────────────────────────────── --}}
        <div style="display:flex;align-items:center;gap:0;margin-bottom:40px;max-width:480px;">
            @foreach([1 => 'Data Siswa', 2 => 'Data Orang Tua', 3 => 'Dokumen'] as $n => $label)
                <div style="display:flex;align-items:center;flex:1;gap:0;">
                    <div style="display:flex;flex-direction:column;align-items:center;gap:6px;flex:0 0 auto;">
                        <div style="
                            width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;
                            font-family:var(--font-sans);font-size:var(--text-sm);font-weight:700;
                            {{ $step > $n ? 'background:var(--green-600);color:#fff;' : ($step === $n ? 'background:var(--green-600);color:#fff;box-shadow:0 0 0 4px var(--green-100);' : 'background:var(--cream-200);color:var(--ink-400);') }}
                        ">
                            @if($step > $n)
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                            @else
                                {{ $n }}
                            @endif
                        </div>
                        <span style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:{{ $step === $n ? '700' : '500' }};color:{{ $step === $n ? 'var(--green-700)' : 'var(--ink-400)' }};white-space:nowrap;">{{ $label }}</span>
                    </div>
                    @if($n < 3)
                        <div style="flex:1;height:2px;background:{{ $step > $n ? 'var(--green-600)' : 'var(--cream-200)' }};margin:0 6px;margin-bottom:20px;"></div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- ── Step 1: Data Calon Siswa ────────────────────────────────────── --}}
        @if($step === 1)
            <form wire:submit.prevent="nextStep">
                <div style="display:flex;flex-direction:column;gap:20px;">

                    <div class="am-form-group">
                        <label class="am-label am-label--required">Nama Lengkap Calon Siswa</label>
                        <input wire:model="student_name" type="text" class="am-input @error('student_name') am-input--error @enderror" placeholder="Sesuai akta kelahiran">
                        @error('student_name')<p class="am-field-error">{{ $message }}</p>@enderror
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="am-form-group">
                            <label class="am-label am-label--required">Tempat Lahir</label>
                            <input wire:model="birth_place" type="text" class="am-input @error('birth_place') am-input--error @enderror" placeholder="Kota Bekasi">
                            @error('birth_place')<p class="am-field-error">{{ $message }}</p>@enderror
                        </div>
                        <div class="am-form-group">
                            <label class="am-label am-label--required">Tanggal Lahir</label>
                            <input wire:model="birth_date" type="date" class="am-input @error('birth_date') am-input--error @enderror">
                            @error('birth_date')<p class="am-field-error">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="am-form-group">
                            <label class="am-label am-label--required">Jenis Kelamin</label>
                            <select wire:model="gender" class="am-input @error('gender') am-input--error @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                            @error('gender')<p class="am-field-error">{{ $message }}</p>@enderror
                        </div>
                        <div class="am-form-group">
                            <label class="am-label am-label--required">Agama</label>
                            <select wire:model="religion" class="am-input @error('religion') am-input--error @enderror">
                                <option value="">-- Pilih --</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                            @error('religion')<p class="am-field-error">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label class="am-label">Asal Sekolah / TK Sebelumnya <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <input wire:model="previous_school" type="text" class="am-input" placeholder="Nama sekolah/TK asal, kosongkan jika belum sekolah">
                    </div>

                </div>

                <div style="display:flex;justify-content:flex-end;margin-top:32px;">
                    <button type="submit" class="am-btn am-btn--primary am-btn--md" wire:loading.attr="disabled">
                        <span wire:loading.remove>Selanjutnya →</span>
                        <span wire:loading>Memproses...</span>
                    </button>
                </div>
            </form>
        @endif

        {{-- ── Step 2: Data Orang Tua/Wali ────────────────────────────────── --}}
        @if($step === 2)
            <form wire:submit.prevent="nextStep">
                <div style="display:flex;flex-direction:column;gap:20px;">

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="am-form-group">
                            <label class="am-label am-label--required">Nama Ayah</label>
                            <input wire:model="father_name" type="text" class="am-input @error('father_name') am-input--error @enderror" placeholder="Nama lengkap ayah">
                            @error('father_name')<p class="am-field-error">{{ $message }}</p>@enderror
                        </div>
                        <div class="am-form-group">
                            <label class="am-label am-label--required">Nama Ibu</label>
                            <input wire:model="mother_name" type="text" class="am-input @error('mother_name') am-input--error @enderror" placeholder="Nama lengkap ibu">
                            @error('mother_name')<p class="am-field-error">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="am-form-group">
                            <label class="am-label am-label--required">No. HP / WhatsApp</label>
                            <input wire:model="phone" type="tel" class="am-input @error('phone') am-input--error @enderror" placeholder="08xxxxxxxxxx">
                            @error('phone')<p class="am-field-error">{{ $message }}</p>@enderror
                        </div>
                        <div class="am-form-group">
                            <label class="am-label">Email <span style="color:var(--ink-400);font-weight:400;">(opsional, untuk konfirmasi)</span></label>
                            <input wire:model="email" type="email" class="am-input @error('email') am-input--error @enderror" placeholder="email@contoh.com">
                            @error('email')<p class="am-field-error">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="am-form-group">
                        <label class="am-label am-label--required">Alamat Lengkap</label>
                        <textarea wire:model="address" class="am-input @error('address') am-input--error @enderror" rows="3" placeholder="Jl. ... RT/RW ... Kel. ... Kec. ... Kota ..."></textarea>
                        @error('address')<p class="am-field-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="am-form-group">
                        <label class="am-label">Pekerjaan Orang Tua <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <input wire:model="parent_job" type="text" class="am-input" placeholder="Pegawai Swasta, Wiraswasta, dll.">
                    </div>

                </div>

                <div style="display:flex;justify-content:space-between;margin-top:32px;">
                    <button type="button" wire:click="prevStep" class="am-btn am-btn--outline am-btn--md">← Kembali</button>
                    <button type="submit" class="am-btn am-btn--primary am-btn--md" wire:loading.attr="disabled">
                        <span wire:loading.remove>Selanjutnya →</span>
                        <span wire:loading>Memproses...</span>
                    </button>
                </div>
            </form>
        @endif

        {{-- ── Step 3: Upload Dokumen ───────────────────────────────────────── --}}
        @if($step === 3)
            <form wire:submit.prevent="submit">
                <p style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-500);line-height:1.65;margin:0 0 24px;">
                    Upload dokumen dalam format <strong>JPG, PNG, atau PDF</strong>. Pastikan dokumen terbaca dengan jelas.
                </p>

                <div style="display:flex;flex-direction:column;gap:20px;">

                    <div class="am-form-group">
                        <label class="am-label am-label--required">Kartu Keluarga (KK)</label>
                        <p style="font-size:var(--text-xs);color:var(--ink-400);margin:0 0 8px;">JPG / PNG / PDF · Maks. 2 MB</p>
                        <input wire:model="doc_kk" type="file" accept=".jpg,.jpeg,.png,.pdf" class="am-input-file @error('doc_kk') am-input--error @enderror">
                        @error('doc_kk')<p class="am-field-error">{{ $message }}</p>@enderror
                        @if($doc_kk && !$errors->has('doc_kk'))
                            <p style="font-size:var(--text-xs);color:var(--success-500);margin:4px 0 0;">✓ {{ $doc_kk->getClientOriginalName() }}</p>
                        @endif
                        <div wire:loading wire:target="doc_kk" style="font-size:var(--text-xs);color:var(--ink-400);margin-top:4px;">Mengupload...</div>
                    </div>

                    <div class="am-form-group">
                        <label class="am-label am-label--required">Akta Kelahiran</label>
                        <p style="font-size:var(--text-xs);color:var(--ink-400);margin:0 0 8px;">JPG / PNG / PDF · Maks. 2 MB</p>
                        <input wire:model="doc_akta" type="file" accept=".jpg,.jpeg,.png,.pdf" class="am-input-file @error('doc_akta') am-input--error @enderror">
                        @error('doc_akta')<p class="am-field-error">{{ $message }}</p>@enderror
                        @if($doc_akta && !$errors->has('doc_akta'))
                            <p style="font-size:var(--text-xs);color:var(--success-500);margin:4px 0 0;">✓ {{ $doc_akta->getClientOriginalName() }}</p>
                        @endif
                        <div wire:loading wire:target="doc_akta" style="font-size:var(--text-xs);color:var(--ink-400);margin-top:4px;">Mengupload...</div>
                    </div>

                    <div class="am-form-group">
                        <label class="am-label am-label--required">Foto Calon Siswa</label>
                        <p style="font-size:var(--text-xs);color:var(--ink-400);margin:0 0 8px;">JPG / PNG · Maks. 1 MB · Foto terbaru, background polos</p>
                        <input wire:model="doc_foto" type="file" accept=".jpg,.jpeg,.png" class="am-input-file @error('doc_foto') am-input--error @enderror">
                        @error('doc_foto')<p class="am-field-error">{{ $message }}</p>@enderror
                        @if($doc_foto && !$errors->has('doc_foto'))
                            <p style="font-size:var(--text-xs);color:var(--success-500);margin:4px 0 0;">✓ {{ $doc_foto->getClientOriginalName() }}</p>
                        @endif
                        <div wire:loading wire:target="doc_foto" style="font-size:var(--text-xs);color:var(--ink-400);margin-top:4px;">Mengupload...</div>
                    </div>

                </div>

                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:32px;">
                    <button type="button" wire:click="prevStep" class="am-btn am-btn--outline am-btn--md">← Kembali</button>
                    <button type="submit" class="am-btn am-btn--primary am-btn--md" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="submit">Kirim Pendaftaran</span>
                        <span wire:loading wire:target="submit">Mengirim...</span>
                    </button>
                </div>
            </form>
        @endif

    @endif
</div>
