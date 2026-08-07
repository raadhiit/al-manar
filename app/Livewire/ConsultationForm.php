<?php

namespace App\Livewire;

use App\Models\Consultation;
use App\Models\School;
use Livewire\Component;

class ConsultationForm extends Component
{
    public string $parent_name = '';
    public string $whatsapp = '';
    public string $child_info = '';
    public string $domicile = '';
    public string $school_id = '';
    public string $interest_type = 'konsultasi';

    public bool $submitted = false;
    public string $waLink = '';

    protected function rules(): array
    {
        return [
            'parent_name' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'child_info' => 'nullable|string|max:255',
            'domicile' => 'nullable|string|max:255',
            'school_id' => 'required|exists:schools,id',
            'interest_type' => 'required|in:brosur,konsultasi,kunjungan',
        ];
    }

    protected array $messages = [
        'parent_name.required' => 'Nama orang tua/wali wajib diisi.',
        'whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
        'school_id.required' => 'Pilih unit yang diminati.',
    ];

    public function submit(): void
    {
        $data = $this->validate();

        Consultation::create($data);

        $school = School::find($this->school_id);
        $interestLabel = match ($this->interest_type) {
            'brosur' => 'minta brosur',
            'kunjungan' => 'jadwalkan kunjungan',
            default => 'konsultasi',
        };

        $message = "Assalamu'alaikum, saya {$this->parent_name} ingin {$interestLabel} untuk pendaftaran di " . ($school?->name ?? 'Al Manar') . '. Mohon bantuannya, terima kasih.';

        $this->waLink = 'https://wa.me/6282260705227?text=' . rawurlencode($message);
        $this->submitted = true;
    }

    public function render()
    {
        return view('livewire.consultation-form', [
            'schools' => School::whereIn('slug', ['sdit', 'kelompok-bermain-raudhatul-athfal'])->get(),
        ]);
    }
}
