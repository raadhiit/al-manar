<?php

namespace App\Livewire\Guru;

use App\Models\Rpp;
use App\Services\UploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.guru')]
class RppManager extends Component
{
    use WithFileUploads;

    public bool $showModal = false;
    public ?int $editingId = null;

    public string $subject = '';
    public string $class = '';
    public string $semester = '';
    public string $academic_year = '';
    public $file = null;

    protected function rules(): array
    {
        return [
            'subject'       => 'required|string|max:255',
            'class'         => 'required|string|max:50',
            'semester'      => 'required|in:1,2',
            'academic_year' => 'required|string|max:20',
            'file'          => ($this->editingId ? 'nullable' : 'required') . '|file|mimes:pdf,doc,docx|max:10240',
        ];
    }

    public function openCreate(): void
    {
        $this->reset(['editingId', 'subject', 'class', 'semester', 'academic_year', 'file']);
        $this->showModal = true;
    }

    public function edit(int $id): void
    {
        $rpp = Rpp::forUser(Auth::id())->findOrFail($id);

        $this->editingId     = $rpp->id;
        $this->subject       = $rpp->subject;
        $this->class         = $rpp->class;
        $this->semester      = $rpp->semester;
        $this->academic_year = $rpp->academic_year;
        $this->file          = null;
        $this->showModal     = true;
    }

    public function save(): void
    {
        $this->validate();

        $upload = app(UploadService::class);

        if ($this->editingId) {
            $rpp = Rpp::forUser(Auth::id())->findOrFail($this->editingId);

            if ($this->file) {
                Storage::disk('public')->delete($rpp->file_path);
                $rpp->file_path = $upload->storePublic($this->file, 'rpps');
                $rpp->original_filename = $this->file->getClientOriginalName();
            }

            $rpp->fill([
                'subject'       => $this->subject,
                'class'         => $this->class,
                'semester'      => $this->semester,
                'academic_year' => $this->academic_year,
            ])->save();
        } else {
            Rpp::create([
                'user_id'           => Auth::id(),
                'school_id'         => Auth::user()->school_id,
                'subject'           => $this->subject,
                'class'             => $this->class,
                'semester'          => $this->semester,
                'academic_year'     => $this->academic_year,
                'file_path'         => $upload->storePublic($this->file, 'rpps'),
                'original_filename' => $this->file->getClientOriginalName(),
            ]);
        }

        $this->showModal = false;
        $this->reset(['editingId', 'subject', 'class', 'semester', 'academic_year', 'file']);
    }

    public function delete(int $id): void
    {
        Rpp::forUser(Auth::id())->findOrFail($id);
        Rpp::deleteById($id);
    }

    public function render()
    {
        return view('livewire.guru.rpp-manager', [
            'rpps' => Rpp::forUser(Auth::id())->latest()->get(),
        ]);
    }
}
