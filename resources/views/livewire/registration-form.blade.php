<div>
    {{-- ── Success state ────────────────────────────────────────────────── --}}
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
        {{-- ── Step indicator ──────────────────────────────────────────── --}}
        @php $steps = [1 => 'Data Siswa', 2 => 'Alamat', 3 => 'Orang Tua', 4 => 'Dokumen']; $lastStep = count($steps); @endphp
        <div style="display:flex;align-items:flex-start;margin-bottom:40px;">
            @foreach($steps as $n => $label)
                <div style="flex:1;display:flex;flex-direction:column;align-items:center;min-width:0;">
                    <div style="display:flex;align-items:center;width:100%;">
                        <div style="flex:1;height:2px;{{ $n === 1 ? 'visibility:hidden;' : 'background:' . ($step >= $n ? 'var(--green-600)' : 'var(--cream-200)') . ';' }}"></div>
                        <div style="width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex:0 0 36px;font-family:var(--font-sans);font-size:var(--text-sm);font-weight:700;{{ $step > $n ? 'background:var(--green-600);color:#fff;' : ($step === $n ? 'background:var(--green-600);color:#fff;box-shadow:0 0 0 4px var(--green-100);' : 'background:var(--cream-200);color:var(--ink-400);') }}">
                            @if($step > $n)
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><polyline points="20 6 9 17 4 12"/></svg>
                            @else
                                {{ $n }}
                            @endif
                        </div>
                        <div style="flex:1;height:2px;{{ $n === $lastStep ? 'visibility:hidden;' : 'background:' . ($step > $n ? 'var(--green-600)' : 'var(--cream-200)') . ';' }}"></div>
                    </div>
                    <span style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:{{ $step === $n ? '700' : '500' }};color:{{ $step === $n ? 'var(--green-700)' : 'var(--ink-400)' }};margin-top:6px;white-space:nowrap;">{{ $label }}</span>
                </div>
            @endforeach
        </div>

        {{-- ── Step 1: Data Siswa ───────────────────────────────────────── --}}
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
                        <label class="am-label">NIK Siswa <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <input wire:model="nik" type="text" class="am-input" placeholder="16 digit NIK" maxlength="16">
                    </div>
                    <div class="am-form-group">
                        <label class="am-label">NISN <span style="color:var(--ink-400);font-weight:400;">(untuk lulusan TK)</span></label>
                        <input wire:model="nisn" type="text" class="am-input" placeholder="10 digit NISN" maxlength="10">
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
                        <label class="am-label">No. Registrasi Akta Lahir <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <input wire:model="birth_certificate_no" type="text" class="am-input" placeholder="Nomor registrasi akta">
                    </div>
                    <div class="am-form-group">
                        <label class="am-label am-label--required">Kewarganegaraan</label>
                        <select wire:model="citizenship" class="am-input @error('citizenship') am-input--error @enderror">
                            <option value="WNI">WNI</option>
                            <option value="WNA">WNA</option>
                        </select>
                        @error('citizenship')<p class="am-field-error">{{ $message }}</p>@enderror
                    </div>
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

        {{-- ── Step 2: Alamat & Detail ──────────────────────────────────── --}}
        @if($step === 2)
        <form wire:submit.prevent="nextStep">
            <div style="display:flex;flex-direction:column;gap:20px;">

                {{-- Alamat --}}
                <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--ink-400);padding-bottom:6px;border-bottom:1px solid var(--sand-200);">Alamat Lengkap</div>

                <div class="am-form-group">
                    <label class="am-label am-label--required">Alamat Jalan</label>
                    <input wire:model="address_street" type="text" class="am-input @error('address_street') am-input--error @enderror" placeholder="Jl. ... No. ...">
                    @error('address_street')<p class="am-field-error">{{ $message }}</p>@enderror
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:16px;">
                    <div class="am-form-group">
                        <label class="am-label am-label--required">RT</label>
                        <input wire:model="address_rt" type="text" class="am-input @error('address_rt') am-input--error @enderror" placeholder="001">
                        @error('address_rt')<p class="am-field-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="am-form-group">
                        <label class="am-label am-label--required">RW</label>
                        <input wire:model="address_rw" type="text" class="am-input @error('address_rw') am-input--error @enderror" placeholder="002">
                        @error('address_rw')<p class="am-field-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="am-form-group" style="grid-column:span 2;">
                        <label class="am-label am-label--required">Kelurahan / Desa</label>
                        <input wire:model="address_kelurahan" type="text" class="am-input @error('address_kelurahan') am-input--error @enderror" placeholder="Nama kelurahan">
                        @error('address_kelurahan')<p class="am-field-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="am-form-group">
                        <label class="am-label am-label--required">Kecamatan</label>
                        <input wire:model="address_kecamatan" type="text" class="am-input @error('address_kecamatan') am-input--error @enderror" placeholder="Nama kecamatan">
                        @error('address_kecamatan')<p class="am-field-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="am-form-group">
                        <label class="am-label am-label--required">Kode Pos</label>
                        <input wire:model="address_kode_pos" type="text" class="am-input @error('address_kode_pos') am-input--error @enderror" placeholder="17xxx" maxlength="5">
                        @error('address_kode_pos')<p class="am-field-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="am-form-group">
                        <label class="am-label">Tempat Tinggal <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <select wire:model="living_arrangement" class="am-input">
                            <option value="">-- Pilih --</option>
                            <option value="Bersama Orang Tua">Bersama Orang Tua</option>
                            <option value="Bersama Wali">Bersama Wali</option>
                            <option value="Kos">Kos</option>
                            <option value="Asrama">Asrama</option>
                            <option value="Panti Asuhan">Panti Asuhan</option>
                            <option value="Pesantren">Pesantren</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="am-form-group">
                        <label class="am-label">Moda Transportasi <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <select wire:model="transport_mode" class="am-input">
                            <option value="">-- Pilih --</option>
                            <option value="Jalan Kaki">Jalan Kaki</option>
                            <option value="Kendaraan Pribadi">Kendaraan Pribadi</option>
                            <option value="Kendaraan Umum/Angkot">Kendaraan Umum/Angkot</option>
                            <option value="Jemputan Sekolah">Jemputan Sekolah</option>
                            <option value="Kereta Api">Kereta Api</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>

                {{-- Detail Siswa --}}
                <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--ink-400);padding-bottom:6px;border-bottom:1px solid var(--sand-200);margin-top:4px;">Detail Siswa <span style="font-weight:400;text-transform:none;letter-spacing:0;">(opsional)</span></div>

                <div style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:16px;">
                    <div class="am-form-group">
                        <label class="am-label">Anak ke-</label>
                        <input wire:model="sibling_order" type="number" class="am-input" placeholder="1" min="1" max="20">
                    </div>
                    <div class="am-form-group">
                        <label class="am-label">Jml. Saudara</label>
                        <input wire:model="sibling_count" type="number" class="am-input" placeholder="0" min="0" max="20">
                    </div>
                    <div class="am-form-group">
                        <label class="am-label">Tinggi (cm)</label>
                        <input wire:model="height" type="number" class="am-input" placeholder="100" min="50" max="200">
                    </div>
                    <div class="am-form-group">
                        <label class="am-label">Berat (kg)</label>
                        <input wire:model="weight" type="number" class="am-input" placeholder="20" min="5" max="150">
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="am-form-group">
                        <label class="am-label">Jarak ke Sekolah</label>
                        <input wire:model="distance_to_school" type="text" class="am-input" placeholder="Cth: 2 km / 500 m">
                    </div>
                    <div class="am-form-group">
                        <label class="am-label">Waktu Tempuh</label>
                        <input wire:model="travel_time" type="text" class="am-input" placeholder="Cth: 15 menit">
                    </div>
                </div>

                {{-- Sekolah Asal --}}
                <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--ink-400);padding-bottom:6px;border-bottom:1px solid var(--sand-200);margin-top:4px;">Sekolah Asal <span style="font-weight:400;text-transform:none;letter-spacing:0;">(opsional)</span></div>

                <div style="display:grid;grid-template-columns:160px 1fr;gap:16px;">
                    <div class="am-form-group">
                        <label class="am-label">Jenis</label>
                        <select wire:model="prev_school_type" class="am-input">
                            <option value="">-- Pilih --</option>
                            <option value="TK">TK</option>
                            <option value="BIMBA">BIMBA</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div class="am-form-group">
                        <label class="am-label">Nama Sekolah</label>
                        <input wire:model="previous_school" type="text" class="am-input" placeholder="Nama TK/BIMBA asal">
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 180px;gap:16px;">
                    <div class="am-form-group">
                        <label class="am-label">Alamat Sekolah</label>
                        <input wire:model="prev_school_address" type="text" class="am-input" placeholder="Alamat sekolah asal">
                    </div>
                    <div class="am-form-group">
                        <label class="am-label">NPSN</label>
                        <input wire:model="prev_school_npsn" type="text" class="am-input" placeholder="8 digit NPSN" maxlength="8">
                    </div>
                </div>

                {{-- Info Sosial Ekonomi --}}
                <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--ink-400);padding-bottom:6px;border-bottom:1px solid var(--sand-200);margin-top:4px;">Info Sosial Ekonomi <span style="font-weight:400;text-transform:none;letter-spacing:0;">(opsional)</span></div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="am-form-group">
                        <label class="am-label">No. KKS (Kartu Keluarga Sejahtera)</label>
                        <input wire:model="kks_number" type="text" class="am-input" placeholder="Nomor KKS">
                    </div>
                    <div class="am-form-group">
                        <label class="am-label">No. KPS / PKH</label>
                        <input wire:model="kps_number" type="text" class="am-input" placeholder="Nomor KPS/PKH">
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:160px 1fr;gap:16px;align-items:start;">
                    <div class="am-form-group">
                        <label class="am-label">Penerima KIP?</label>
                        <select wire:model="kip_recipient" class="am-input">
                            <option value="">-- Pilih --</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>
                    @if($kip_recipient === 'Ya')
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                        <div class="am-form-group">
                            <label class="am-label">Nomor KIP</label>
                            <input wire:model="kip_number" type="text" class="am-input" placeholder="Nomor KIP">
                        </div>
                        <div class="am-form-group">
                            <label class="am-label">Nama Tertera di KIP</label>
                            <input wire:model="kip_name" type="text" class="am-input" placeholder="Sesuai KIP">
                        </div>
                    </div>
                    @else
                    <div></div>
                    @endif
                </div>

                @if($kip_recipient === 'Ya')
                <div style="display:grid;grid-template-columns:160px 1fr;gap:16px;">
                    <div class="am-form-group">
                        <label class="am-label">Terima fisik kartu KIP?</label>
                        <select wire:model="kip_card_received" class="am-input">
                            <option value="">-- Pilih --</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                    </div>
                    <div></div>
                </div>
                @endif

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

        {{-- ── Step 3: Data Orang Tua ───────────────────────────────────── --}}
        @if($step === 3)
        <form wire:submit.prevent="nextStep">
            <div style="display:flex;flex-direction:column;gap:20px;">

                {{-- Ayah --}}
                <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--ink-400);padding-bottom:6px;border-bottom:1px solid var(--sand-200);">Data Ayah</div>

                <div class="am-form-group">
                    <label class="am-label am-label--required">Nama Lengkap Ayah</label>
                    <input wire:model="father_name" type="text" class="am-input @error('father_name') am-input--error @enderror" placeholder="Nama lengkap ayah kandung">
                    @error('father_name')<p class="am-field-error">{{ $message }}</p>@enderror
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="am-form-group">
                        <label class="am-label">Tempat Lahir Ayah <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <input wire:model="father_birthplace" type="text" class="am-input" placeholder="Kota kelahiran ayah">
                    </div>
                    <div class="am-form-group">
                        <label class="am-label">Tanggal Lahir Ayah <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <input wire:model="father_birthdate" type="date" class="am-input">
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="am-form-group">
                        <label class="am-label">Pendidikan Terakhir Ayah <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <select wire:model="father_education" class="am-input">
                            <option value="">-- Pilih --</option>
                            <option value="SD/MI">SD/MI</option>
                            <option value="SMP/MTs">SMP/MTs</option>
                            <option value="SMA/SMK/MA">SMA/SMK/MA</option>
                            <option value="D1/D2/D3">D1/D2/D3</option>
                            <option value="S1/D4">S1/D4</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                    <div class="am-form-group">
                        <label class="am-label">Pekerjaan Ayah <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <input wire:model="father_job" type="text" class="am-input" placeholder="Cth: Pegawai Swasta">
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="am-form-group">
                        <label class="am-label">Penghasilan Ayah <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <select wire:model="father_income" class="am-input">
                            <option value="">-- Pilih --</option>
                            <option value="0 - Rp 1.000.000">0 – Rp 1.000.000</option>
                            <option value="Rp 1.000.000 - Rp 2.000.000">Rp 1.000.000 – Rp 2.000.000</option>
                            <option value="Rp 2.000.000 - Rp 5.000.000">Rp 2.000.000 – Rp 5.000.000</option>
                            <option value="Rp 5.000.000 Ke Atas">Rp 5.000.000 ke atas</option>
                        </select>
                    </div>
                    <div class="am-form-group">
                        <label class="am-label am-label--required">No. HP / WA Ayah</label>
                        <input wire:model="father_phone" type="tel" class="am-input @error('father_phone') am-input--error @enderror" placeholder="08xxxxxxxxxx">
                        @error('father_phone')<p class="am-field-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Ibu --}}
                <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--ink-400);padding-bottom:6px;border-bottom:1px solid var(--sand-200);margin-top:4px;">Data Ibu</div>

                <div class="am-form-group">
                    <label class="am-label am-label--required">Nama Lengkap Ibu</label>
                    <input wire:model="mother_name" type="text" class="am-input @error('mother_name') am-input--error @enderror" placeholder="Nama lengkap ibu kandung">
                    @error('mother_name')<p class="am-field-error">{{ $message }}</p>@enderror
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="am-form-group">
                        <label class="am-label">Tempat Lahir Ibu <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <input wire:model="mother_birthplace" type="text" class="am-input" placeholder="Kota kelahiran ibu">
                    </div>
                    <div class="am-form-group">
                        <label class="am-label">Tanggal Lahir Ibu <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <input wire:model="mother_birthdate" type="date" class="am-input">
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="am-form-group">
                        <label class="am-label">Pendidikan Terakhir Ibu <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <select wire:model="mother_education" class="am-input">
                            <option value="">-- Pilih --</option>
                            <option value="SD/MI">SD/MI</option>
                            <option value="SMP/MTs">SMP/MTs</option>
                            <option value="SMA/SMK/MA">SMA/SMK/MA</option>
                            <option value="D1/D2/D3">D1/D2/D3</option>
                            <option value="S1/D4">S1/D4</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                    <div class="am-form-group">
                        <label class="am-label">Pekerjaan Ibu <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <input wire:model="mother_job" type="text" class="am-input" placeholder="Cth: Ibu Rumah Tangga">
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
                    <div class="am-form-group">
                        <label class="am-label">Penghasilan Ibu <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <select wire:model="mother_income" class="am-input">
                            <option value="">-- Pilih --</option>
                            <option value="0 - Rp 1.000.000">0 – Rp 1.000.000</option>
                            <option value="Rp 1.000.000 - Rp 2.000.000">Rp 1.000.000 – Rp 2.000.000</option>
                            <option value="Rp 2.000.000 - Rp 5.000.000">Rp 2.000.000 – Rp 5.000.000</option>
                            <option value="Rp 5.000.000 Ke Atas">Rp 5.000.000 ke atas</option>
                        </select>
                    </div>
                    <div class="am-form-group">
                        <label class="am-label">No. HP / WA Ibu <span style="color:var(--ink-400);font-weight:400;">(opsional)</span></label>
                        <input wire:model="mother_phone" type="tel" class="am-input" placeholder="08xxxxxxxxxx">
                    </div>
                </div>

                {{-- Email --}}
                <div class="am-form-group">
                    <label class="am-label">Email <span style="color:var(--ink-400);font-weight:400;">(opsional, untuk konfirmasi pendaftaran)</span></label>
                    <input wire:model="email" type="email" class="am-input @error('email') am-input--error @enderror" placeholder="email@contoh.com">
                    @error('email')<p class="am-field-error">{{ $message }}</p>@enderror
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

        {{-- ── Step 4: Upload Dokumen ────────────────────────────────────── --}}
        @if($step === 4)
        {{-- Loading overlay saat submit --}}
        <div wire:loading.flex wire:target="submit"
            style="position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:9999;flex-direction:column;align-items:center;justify-content:center;gap:16px;">
            <div style="width:52px;height:52px;border:4px solid rgba(255,255,255,.25);border-top-color:#fff;border-radius:50%;animation:spin .75s linear infinite;"></div>
            <p style="font-family:var(--font-sans);font-size:var(--text-sm);font-weight:600;color:#fff;margin:0;">Mengirim pendaftaran...</p>
            <p style="font-family:var(--font-sans);font-size:var(--text-xs);color:rgba(255,255,255,.7);margin:0;">Mohon tunggu, sedang mengupload dokumen</p>
        </div>
        <style>@keyframes spin{to{transform:rotate(360deg)}}</style>

        <form wire:submit.prevent="submit">

            {{-- Info rekening --}}
            <div style="background:var(--green-50);border:1.5px solid var(--green-200);border-radius:var(--radius-md);padding:16px 20px;margin-bottom:24px;">
                <div style="font-family:var(--font-sans);font-size:var(--text-xs);font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--green-700);margin-bottom:10px;">Transfer Biaya Pendaftaran</div>
                <div style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-700);line-height:1.8;">
                    Sebelum mengupload dokumen, transfer biaya pendaftaran sebesar
                    <strong style="color:var(--green-800);">Rp 250.000</strong> ke rekening berikut:
                </div>
                <div style="margin-top:12px;display:flex;flex-direction:column;gap:6px;">
                    <div style="display:flex;gap:12px;font-family:var(--font-sans);font-size:var(--text-sm);">
                        <span style="color:var(--ink-400);min-width:100px;">Bank</span>
                        <strong style="color:var(--ink-900);">Bank Syariah Indonesia (BSI)</strong>
                    </div>
                    <div style="display:flex;gap:12px;font-family:var(--font-sans);font-size:var(--text-sm);">
                        <span style="color:var(--ink-400);min-width:100px;">No. Rekening</span>
                        <strong style="color:var(--ink-900);letter-spacing:.05em;">7XXXXXXXXXX</strong>
                    </div>
                    <div style="display:flex;gap:12px;font-family:var(--font-sans);font-size:var(--text-sm);">
                        <span style="color:var(--ink-400);min-width:100px;">Atas Nama</span>
                        <strong style="color:var(--ink-900);">Yayasan Al Muhajirin Almanar</strong>
                    </div>
                </div>
                <p style="font-family:var(--font-sans);font-size:var(--text-xs);color:var(--ink-500);margin:10px 0 0;line-height:1.6;">
                    Gunakan nama calon siswa sebagai berita transfer. Simpan bukti transfer untuk diupload di bawah.
                </p>
            </div>

            <p style="font-family:var(--font-sans);font-size:var(--text-sm);color:var(--ink-500);line-height:1.65;margin:0 0 20px;">
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

                <div class="am-form-group">
                    <label class="am-label am-label--required">Bukti Transfer Biaya Pendaftaran</label>
                    <p style="font-size:var(--text-xs);color:var(--ink-400);margin:0 0 8px;">JPG / PNG / PDF · Maks. 2 MB · Screenshot atau foto struk transfer Rp 250.000</p>
                    <input wire:model="doc_transfer" type="file" accept=".jpg,.jpeg,.png,.pdf" class="am-input-file @error('doc_transfer') am-input--error @enderror">
                    @error('doc_transfer')<p class="am-field-error">{{ $message }}</p>@enderror
                    @if($doc_transfer && !$errors->has('doc_transfer'))
                        <p style="font-size:var(--text-xs);color:var(--success-500);margin:4px 0 0;">✓ {{ $doc_transfer->getClientOriginalName() }}</p>
                    @endif
                    <div wire:loading wire:target="doc_transfer" style="font-size:var(--text-xs);color:var(--ink-400);margin-top:4px;">Mengupload...</div>
                </div>

                <div class="am-form-group">
                    <label class="am-label">Fotokopi KTP Ayah & Ibu <span style="color:var(--ink-400);font-weight:400;">(opsional, bisa dibawa saat penyerahan formulir fisik)</span></label>
                    <p style="font-size:var(--text-xs);color:var(--ink-400);margin:0 0 8px;">JPG / PNG / PDF · Maks. 2 MB · Gabungkan KTP Ayah & Ibu dalam 1 file</p>
                    <input wire:model="doc_ktp" type="file" accept=".jpg,.jpeg,.png,.pdf" class="am-input-file @error('doc_ktp') am-input--error @enderror">
                    @error('doc_ktp')<p class="am-field-error">{{ $message }}</p>@enderror
                    @if($doc_ktp && !$errors->has('doc_ktp'))
                        <p style="font-size:var(--text-xs);color:var(--success-500);margin:4px 0 0;">✓ {{ $doc_ktp->getClientOriginalName() }}</p>
                    @endif
                    <div wire:loading wire:target="doc_ktp" style="font-size:var(--text-xs);color:var(--ink-400);margin-top:4px;">Mengupload...</div>
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
