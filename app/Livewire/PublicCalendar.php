<?php

namespace App\Livewire;

use App\Models\CalendarEvent;
use App\Models\School;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;
use Livewire\Component;

class PublicCalendar extends Component
{
    #[Url]
    public ?string $jenjang = null;

    #[Url]
    public ?int $month = null;

    #[Url]
    public ?int $year = null;

    public function mount(): void
    {
        $this->month ??= (int) now()->month;
        $this->year ??= (int) now()->year;
    }

    public function setJenjang(?string $jenjang): void
    {
        $this->jenjang = $jenjang ?: null;
    }

    public function previousMonth(): void
    {
        $this->month--;

        if ($this->month < 1) {
            $this->month = 12;
            $this->year--;
        }
    }

    public function nextMonth(): void
    {
        $this->month++;

        if ($this->month > 12) {
            $this->month = 1;
            $this->year++;
        }
    }

    public function goToToday(): void
    {
        $this->month = (int) now()->month;
        $this->year = (int) now()->year;
    }

    /**
     * @return Collection<string, Collection<int, CalendarEvent>>
     */
    public function getEventsProperty(): Collection
    {
        $query = CalendarEvent::with('school')->overlappingMonth($this->year, $this->month);

        if ($this->jenjang) {
            $slug = $this->jenjang === 'tkit' ? 'kelompok-bermain-raudhatul-athfal' : $this->jenjang;
            $schoolId = School::where('slug', $slug)->value('id');

            if ($schoolId) {
                // school_id null = agenda berlaku untuk semua unit (mis. libur nasional
                // hasil sync), harus tetap tampil walau lagi difilter ke jenjang tertentu.
                $query->where(fn ($q) => $q->where('school_id', $schoolId)->orWhereNull('school_id'));
            }
        }

        return CalendarEvent::expandToDailyMap($query->orderBy('event_date')->get());
    }

    public function render()
    {
        return view('livewire.public-calendar');
    }
}
