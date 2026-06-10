<?php

namespace App\Livewire;

use App\Mail\RegistrationMail;
use App\Models\Registration;
use App\Models\School;
use App\Services\UploadService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegistrationForm extends Component
{
    use WithFileUploads;

    public string $school;
    public int $step = 1;
    public bool $submitted = false;
    public string $registrationNumber = '';

    // ── Step 1: Data Siswa ──────────────────────────────────────────────
    public string $student_name        = '';
    public string $nik                 = '';
    public string $nisn                = '';
    public string $gender              = '';
    public string $birth_place         = '';
    public string $birth_date          = '';
    public string $birth_certificate_no = '';
    public string $religion            = '';
    public string $citizenship         = 'WNI';

    // ── Step 2: Alamat & Detail ─────────────────────────────────────────
    public string $address_street    = '';
    public string $address_rt        = '';
    public string $address_rw        = '';
    public string $address_kelurahan = '';
    public string $address_kecamatan = '';
    public string $address_kode_pos  = '';
    public string $living_arrangement = '';
    public string $transport_mode    = '';

    public string $sibling_order     = '';
    public string $sibling_count     = '';
    public string $height            = '';
    public string $weight            = '';
    public string $distance_to_school = '';
    public string $travel_time       = '';

    public string $kks_number        = '';
    public string $kps_number        = '';
    public string $kip_recipient     = '';
    public string $kip_number        = '';
    public string $kip_name          = '';
    public string $kip_card_received = '';

    public string $prev_school_type    = '';
    public string $previous_school     = '';
    public string $prev_school_address = '';
    public string $prev_school_npsn    = '';

    // ── Step 3: Data Orang Tua ──────────────────────────────────────────
    public string $father_name       = '';
    public string $father_birthplace = '';
    public string $father_birthdate  = '';
    public string $father_education  = '';
    public string $father_job        = '';
    public string $father_income     = '';
    public string $father_phone      = '';

    public string $mother_name       = '';
    public string $mother_birthplace = '';
    public string $mother_birthdate  = '';
    public string $mother_education  = '';
    public string $mother_job        = '';
    public string $mother_income     = '';
    public string $mother_phone      = '';

    public string $email             = '';

    // ── Step 4: Dokumen ─────────────────────────────────────────────────
    public $doc_kk       = null;
    public $doc_akta     = null;
    public $doc_foto     = null;
    public $doc_ktp      = null;
    public $doc_transfer = null;

    private function rulesStep1(): array
    {
        return [
            'student_name' => 'required|string|max:255',
            'gender'       => 'required|in:L,P',
            'birth_place'  => 'required|string|max:255',
            'birth_date'   => 'required|date|before:today',
            'religion'     => 'required|string|max:100',
            'citizenship'  => 'required|in:WNI,WNA',
        ];
    }

    private function rulesStep2(): array
    {
        return [
            'address_street'    => 'required|string|max:500',
            'address_rt'        => 'required|string|max:10',
            'address_rw'        => 'required|string|max:10',
            'address_kelurahan' => 'required|string|max:255',
            'address_kecamatan' => 'required|string|max:255',
            'address_kode_pos'  => 'required|string|max:10',
        ];
    }

    private function rulesStep3(): array
    {
        return [
            'father_name'  => 'required|string|max:255',
            'mother_name'  => 'required|string|max:255',
            'father_phone' => 'required|string|max:20',
            'email'        => 'nullable|email|max:255',
        ];
    }

    private function rulesStep4(): array
    {
        return [
            'doc_kk'       => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'doc_akta'     => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'doc_foto'     => 'required|file|mimes:jpg,jpeg,png|max:1024',
            'doc_ktp'      => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'doc_transfer' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }

    private function messages(): array
    {
        return [
            'student_name.required'    => 'Nama calon siswa wajib diisi.',
            'gender.required'          => 'Jenis kelamin wajib dipilih.',
            'birth_place.required'     => 'Tempat lahir wajib diisi.',
            'birth_date.required'      => 'Tanggal lahir wajib diisi.',
            'birth_date.before'        => 'Tanggal lahir harus sebelum hari ini.',
            'religion.required'        => 'Agama wajib diisi.',
            'citizenship.required'     => 'Kewarganegaraan wajib dipilih.',
            'address_street.required'  => 'Alamat jalan wajib diisi.',
            'address_rt.required'      => 'RT wajib diisi.',
            'address_rw.required'      => 'RW wajib diisi.',
            'address_kelurahan.required' => 'Kelurahan/Desa wajib diisi.',
            'address_kecamatan.required' => 'Kecamatan wajib diisi.',
            'address_kode_pos.required'  => 'Kode Pos wajib diisi.',
            'father_name.required'     => 'Nama ayah wajib diisi.',
            'mother_name.required'     => 'Nama ibu wajib diisi.',
            'father_phone.required'    => 'Nomor HP/WA Ayah wajib diisi.',
            'email.email'              => 'Format email tidak valid.',
            'doc_kk.required'          => 'Kartu Keluarga wajib diupload.',
            'doc_kk.mimes'             => 'KK harus berformat JPG, PNG, atau PDF.',
            'doc_kk.max'               => 'Ukuran KK maksimal 2 MB.',
            'doc_akta.required'        => 'Akta kelahiran wajib diupload.',
            'doc_akta.mimes'           => 'Akta harus berformat JPG, PNG, atau PDF.',
            'doc_akta.max'             => 'Ukuran akta maksimal 2 MB.',
            'doc_foto.required'        => 'Foto calon siswa wajib diupload.',
            'doc_foto.mimes'           => 'Foto harus berformat JPG atau PNG.',
            'doc_foto.max'             => 'Ukuran foto maksimal 1 MB.',
            'doc_ktp.mimes'            => 'KTP harus berformat JPG, PNG, atau PDF.',
            'doc_ktp.max'              => 'Ukuran KTP maksimal 2 MB.',
            'doc_transfer.required'    => 'Bukti transfer biaya pendaftaran wajib diupload.',
            'doc_transfer.mimes'       => 'Bukti transfer harus berformat JPG, PNG, atau PDF.',
            'doc_transfer.max'         => 'Ukuran bukti transfer maksimal 2 MB.',
        ];
    }

    public function nextStep(): void
    {
        match ($this->step) {
            1 => $this->validate($this->rulesStep1(), $this->messages()),
            2 => $this->validate($this->rulesStep2(), $this->messages()),
            3 => $this->validate($this->rulesStep3(), $this->messages()),
            default => null,
        };

        $this->step++;
    }

    public function prevStep(): void
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function submit(): void
    {
        $this->validate($this->rulesStep4(), $this->messages());

        $slug   = $this->school === 'tkit' ? 'tk' : $this->school;
        $school = School::where('slug', $slug)->firstOrFail();
        $prefix = strtoupper($this->school === 'tkit' ? 'TK' : 'SD') . now()->format('Y');

        DB::transaction(function () use ($school, $prefix) {
            $count  = Registration::where('school_id', $school->id)
                ->whereYear('created_at', now()->year)
                ->lockForUpdate()
                ->count() + 1;

            $number = $prefix . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);

            $address = trim(implode(' ', array_filter([
                $this->address_street,
                $this->address_rt ? "RT {$this->address_rt}" : null,
                $this->address_rw ? "RW {$this->address_rw}" : null,
                $this->address_kelurahan ? "Kel. {$this->address_kelurahan}" : null,
                $this->address_kecamatan ? "Kec. {$this->address_kecamatan}" : null,
                $this->address_kode_pos,
            ])));

            $registration = Registration::create([
                'school_id'            => $school->id,
                'registration_number'  => $number,
                // Data siswa
                'student_name'         => $this->student_name,
                'nik'                  => $this->nik ?: null,
                'nisn'                 => $this->nisn ?: null,
                'birth_date'           => $this->birth_date,
                'birth_place'          => $this->birth_place,
                'birth_certificate_no' => $this->birth_certificate_no ?: null,
                'gender'               => $this->gender,
                'religion'             => $this->religion,
                'citizenship'          => $this->citizenship,
                // Sekolah asal
                'previous_school'      => $this->previous_school ?: null,
                'prev_school_type'     => $this->prev_school_type ?: null,
                'prev_school_address'  => $this->prev_school_address ?: null,
                'prev_school_npsn'     => $this->prev_school_npsn ?: null,
                // Alamat
                'address'              => $address,
                'address_street'       => $this->address_street,
                'address_rt'           => $this->address_rt,
                'address_rw'           => $this->address_rw,
                'address_kelurahan'    => $this->address_kelurahan,
                'address_kecamatan'    => $this->address_kecamatan,
                'address_kode_pos'     => $this->address_kode_pos,
                'living_arrangement'   => $this->living_arrangement ?: null,
                'transport_mode'       => $this->transport_mode ?: null,
                // Detail siswa
                'sibling_order'        => $this->sibling_order ?: null,
                'sibling_count'        => $this->sibling_count ?: null,
                'height'               => $this->height ?: null,
                'weight'               => $this->weight ?: null,
                'distance_to_school'   => $this->distance_to_school ?: null,
                'travel_time'          => $this->travel_time ?: null,
                // Sosial ekonomi
                'kks_number'           => $this->kks_number ?: null,
                'kps_number'           => $this->kps_number ?: null,
                'kip_recipient'        => $this->kip_recipient !== '' ? ($this->kip_recipient === 'Ya') : null,
                'kip_number'           => $this->kip_number ?: null,
                'kip_name'             => $this->kip_name ?: null,
                'kip_card_received'    => $this->kip_card_received !== '' ? ($this->kip_card_received === 'Ya') : null,
                // Data ayah
                'father_name'          => $this->father_name,
                'father_birthplace'    => $this->father_birthplace ?: null,
                'father_birthdate'     => $this->father_birthdate ?: null,
                'father_education'     => $this->father_education ?: null,
                'father_job'           => $this->father_job ?: null,
                'father_income'        => $this->father_income ?: null,
                'father_phone'         => $this->father_phone,
                // Data ibu
                'mother_name'          => $this->mother_name,
                'mother_birthplace'    => $this->mother_birthplace ?: null,
                'mother_birthdate'     => $this->mother_birthdate ?: null,
                'mother_education'     => $this->mother_education ?: null,
                'mother_job'           => $this->mother_job ?: null,
                'mother_income'        => $this->mother_income ?: null,
                'mother_phone'         => $this->mother_phone ?: null,
                // Kontak & meta
                'phone'                => $this->father_phone,
                'email'                => $this->email ?: null,
                'parent_job'           => $this->father_job ?: null,
                'status'               => 'menunggu_verifikasi',
                'submitted_at'         => now(),
            ]);

            $upload = app(UploadService::class);

            $docs = [
                'kk'       => $this->doc_kk,
                'akte'     => $this->doc_akta,
                'foto'     => $this->doc_foto,
                'transfer' => $this->doc_transfer,
            ];
            if ($this->doc_ktp) {
                $docs['ktp'] = $this->doc_ktp;
            }

            foreach ($docs as $type => $file) {
                $path = $upload->storePrivate($file, 'registrations');
                $registration->documents()->create([
                    'type'              => $type,
                    'path'              => $path,
                    'original_filename' => $file->getClientOriginalName(),
                ]);
            }

            if ($this->email) {
                Mail::to($this->email)->send(new RegistrationMail($registration));
            }

            $this->registrationNumber = $registration->registration_number;
        });

        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.registration-form');
    }
}
