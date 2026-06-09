<?php

namespace App\Livewire;

use App\Mail\RegistrationMail;
use App\Models\Registration;
use App\Models\School;
use App\Services\UploadService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegistrationForm extends Component
{
    use WithFileUploads;

    // Prop dari view — 'sdit' atau 'tkit'
    public string $school;

    public int $step = 1;
    public bool $submitted = false;
    public string $registrationNumber = '';

    // ── Step 1: Data calon siswa ────────────────────────────────────────
    public string $student_name   = '';
    public string $birth_date     = '';
    public string $birth_place    = '';
    public string $gender         = '';
    public string $religion       = '';
    public string $previous_school = '';

    // ── Step 2: Data orang tua/wali ────────────────────────────────────
    public string $father_name = '';
    public string $mother_name = '';
    public string $phone       = '';
    public string $email       = '';
    public string $address     = '';
    public string $parent_job  = '';

    // ── Step 3: Upload dokumen ──────────────────────────────────────────
    public $doc_kk   = null;
    public $doc_akta = null;
    public $doc_foto = null;

    private function rulesStep1(): array
    {
        return [
            'student_name' => 'required|string|max:255',
            'birth_date'   => 'required|date|before:today',
            'birth_place'  => 'required|string|max:255',
            'gender'       => 'required|in:L,P',
            'religion'     => 'required|string|max:100',
        ];
    }

    private function rulesStep2(): array
    {
        return [
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'address'     => 'required|string|max:1000',
        ];
    }

    private function rulesStep3(): array
    {
        return [
            'doc_kk'   => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'doc_akta' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'doc_foto' => 'required|file|mimes:jpg,jpeg,png|max:1024',
        ];
    }

    private function messages(): array
    {
        return [
            'student_name.required' => 'Nama calon siswa wajib diisi.',
            'birth_date.required'   => 'Tanggal lahir wajib diisi.',
            'birth_date.before'     => 'Tanggal lahir harus sebelum hari ini.',
            'birth_place.required'  => 'Tempat lahir wajib diisi.',
            'gender.required'       => 'Jenis kelamin wajib dipilih.',
            'religion.required'     => 'Agama wajib diisi.',
            'father_name.required'  => 'Nama ayah wajib diisi.',
            'mother_name.required'  => 'Nama ibu wajib diisi.',
            'phone.required'        => 'Nomor HP/WA wajib diisi.',
            'address.required'      => 'Alamat wajib diisi.',
            'doc_kk.required'       => 'Kartu Keluarga wajib diupload.',
            'doc_kk.mimes'          => 'KK harus berformat JPG, PNG, atau PDF.',
            'doc_kk.max'            => 'Ukuran KK maksimal 2 MB.',
            'doc_akta.required'     => 'Akta kelahiran wajib diupload.',
            'doc_akta.mimes'        => 'Akta harus berformat JPG, PNG, atau PDF.',
            'doc_akta.max'          => 'Ukuran akta maksimal 2 MB.',
            'doc_foto.required'     => 'Foto calon siswa wajib diupload.',
            'doc_foto.mimes'        => 'Foto harus berformat JPG atau PNG.',
            'doc_foto.max'          => 'Ukuran foto maksimal 1 MB.',
        ];
    }

    public function nextStep(): void
    {
        match ($this->step) {
            1 => $this->validate($this->rulesStep1(), $this->messages()),
            2 => $this->validate($this->rulesStep2(), $this->messages()),
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
        $this->validate($this->rulesStep3(), $this->messages());

        $slug     = $this->school === 'tkit' ? 'tk' : $this->school;
        $school   = School::where('slug', $slug)->firstOrFail();
        $year     = now()->format('Y');
        $prefix   = strtoupper($this->school === 'tkit' ? 'TK' : 'SD') . $year;

        DB::transaction(function () use ($school, $prefix) {
            $count  = Registration::where('school_id', $school->id)
                ->whereYear('created_at', now()->year)
                ->lockForUpdate()
                ->count() + 1;

            $number = $prefix . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);

            $registration = Registration::create([
                'school_id'           => $school->id,
                'registration_number' => $number,
                'student_name'        => $this->student_name,
                'birth_date'          => $this->birth_date,
                'birth_place'         => $this->birth_place,
                'gender'              => $this->gender,
                'religion'            => $this->religion,
                'previous_school'     => $this->previous_school ?: null,
                'father_name'         => $this->father_name,
                'mother_name'         => $this->mother_name,
                'phone'               => $this->phone,
                'email'               => $this->email ?: null,
                'address'             => $this->address,
                'parent_job'          => $this->parent_job ?: null,
                'status'              => 'menunggu_verifikasi',
                'submitted_at'        => now(),
            ]);

            $upload = app(UploadService::class);

            foreach ([
                'kk'   => $this->doc_kk,
                'akte' => $this->doc_akta,
                'foto' => $this->doc_foto,
            ] as $type => $file) {
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
