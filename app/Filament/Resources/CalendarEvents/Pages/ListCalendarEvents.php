<?php

namespace App\Filament\Resources\CalendarEvents\Pages;

use App\Filament\Resources\CalendarEvents\CalendarEventResource;
use App\Models\CalendarEvent;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\EmbeddedTable;
use Filament\Schemas\Components\RenderHook;
use Filament\Schemas\Components\View;
use Filament\Schemas\Schema;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;

class ListCalendarEvents extends ListRecords
{
    protected static string $resource = CalendarEventResource::class;

    #[Url]
    public ?int $calendarMonth = null;

    #[Url]
    public ?int $calendarYear = null;

    public function mount(): void
    {
        parent::mount();

        $this->calendarMonth ??= (int) now()->format('n');
        $this->calendarYear ??= (int) now()->format('Y');
    }

    public function previousMonth(): void
    {
        $this->calendarMonth--;

        if ($this->calendarMonth < 1) {
            $this->calendarMonth = 12;
            $this->calendarYear--;
        }
    }

    public function nextMonth(): void
    {
        $this->calendarMonth++;

        if ($this->calendarMonth > 12) {
            $this->calendarMonth = 1;
            $this->calendarYear++;
        }
    }

    public function goToToday(): void
    {
        $this->calendarMonth = (int) now()->format('n');
        $this->calendarYear = (int) now()->format('Y');
    }

    /**
     * Event bulan yang sedang tampil, dikelompokkan per tanggal ('Y-m-d') untuk
     * dirender di grid kalender oleh calendar-grid.blade.php.
     *
     * @return Collection<string, Collection<int, CalendarEvent>>
     */
    public function getMonthEvents(): Collection
    {
        $events = CalendarEvent::with('school')
            ->overlappingMonth($this->calendarYear, $this->calendarMonth)
            ->orderBy('event_date')
            ->get();

        return CalendarEvent::expandToDailyMap($events);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('syncNationalHolidays')
                ->label(fn (): string => "Sync Libur Nasional {$this->calendarYear}")
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->requiresConfirmation()
                ->modalDescription(fn (): string => "Ambil daftar hari libur nasional Indonesia tahun {$this->calendarYear} dari API publik (Nager.Date) dan simpan ke kalender. Event yang sudah ada di tanggal yang sama akan diperbarui, bukan diduplikasi. Cuti bersama tidak termasuk (harus diinput manual).")
                ->action(function (): void {
                    try {
                        $count = CalendarEvent::syncNationalHolidays($this->calendarYear);

                        Notification::make()
                            ->title("{$count} hari libur nasional {$this->calendarYear} berhasil disinkronkan")
                            ->success()
                            ->send();
                    } catch (\Throwable $e) {
                        Notification::make()
                            ->title('Gagal sync hari libur nasional')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),

            CreateAction::make()
                ->fillForm(fn (array $arguments): array => [
                    'event_date' => $arguments['event_date'] ?? now()->toDateString(),
                ]),
        ];
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                View::make('filament.resources.calendar-events.calendar-grid')
                    ->viewData(fn (self $livewire): array => [
                        'events' => $livewire->getMonthEvents(),
                        'month' => $livewire->calendarMonth,
                        'year' => $livewire->calendarYear,
                    ]),
                $this->getTabsContentComponent(),
                RenderHook::make(PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_BEFORE),
                EmbeddedTable::make(),
                RenderHook::make(PanelsRenderHook::RESOURCE_PAGES_LIST_RECORDS_TABLE_AFTER),
            ]);
    }
}
