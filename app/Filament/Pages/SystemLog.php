<?php

namespace App\Filament\Pages;

use App\Models\User;
use BackedEnum;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Auth;

class SystemLog extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Log Sistem';

    protected static ?string $title = 'Log Sistem (Error)';

    protected static ?string $slug = 'system-log';

    protected string $view = 'filament.pages.system-log';

    /** @var array<int, array{timestamp: string, message: string, detail: string}> */
    public array $logs = [];

    public string $from;

    public string $to;

    protected int $maxBytes = 2_000_000;

    protected int $maxEntries = 200;

    public function mount(): void
    {
        $this->from = today()->toDateString();
        $this->to   = today()->toDateString();

        $this->loadLog();
    }

    public function updatedFrom(): void
    {
        $this->loadLog();
    }

    public function updatedTo(): void
    {
        $this->loadLog();
    }

    public static function canAccess(): bool
    {
        /** @var User|null $user */
        $user = Auth::user();

        return $user?->hasRole('super_admin') ?? false;
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('refresh')
                ->label('Muat Ulang')
                ->icon(Heroicon::OutlinedArrowPath)
                ->action('loadLog'),

            Action::make('clear')
                ->label('Bersihkan Log')
                ->icon(Heroicon::OutlinedTrash)
                ->color('danger')
                ->requiresConfirmation()
                ->action('clearLog'),
        ];
    }

    public function loadLog(): void
    {
        $path = storage_path('logs/laravel.log');

        if (! file_exists($path)) {
            $this->logs = [];

            return;
        }

        // Newest first.
        $this->logs = array_reverse($this->extractErrorEntries($path));
    }

    public function clearLog(): void
    {
        $path = storage_path('logs/laravel.log');

        if (file_exists($path)) {
            file_put_contents($path, '');
        }

        $this->loadLog();
    }

    /**
     * @return array<int, array{timestamp: string, message: string, detail: string}>
     */
    protected function extractErrorEntries(string $path): array
    {
        $size = filesize($path);
        $readSize = min($size, $this->maxBytes);

        $fp = fopen($path, 'r');
        fseek($fp, -$readSize, SEEK_END);
        $content = fread($fp, $readSize);
        fclose($fp);

        $from = Carbon::parse($this->from)->startOfDay();
        $to   = Carbon::parse($this->to)->endOfDay();

        // Each log entry starts with a line like "[2026-06-17 17:53:37] production.ERROR: ..."
        $entries = preg_split('/(?=^\[\d{4}-\d{2}-\d{2}[^\]]*\]\s+\S+\.\w+:)/m', $content);

        $errors = [];

        foreach ($entries as $entry) {
            $entry = trim($entry);

            if (! preg_match('/^\[(?<timestamp>\d{4}-\d{2}-\d{2}[^\]]*)\]\s+\S+\.ERROR:\s*(?<message>.*)/', $entry, $m)) {
                continue;
            }

            $timestamp = Carbon::parse($m['timestamp']);

            if ($timestamp->lt($from) || $timestamp->gt($to)) {
                continue;
            }

            // Cut off the numbered stack-trace frames, keep only the header + exception summary.
            $detail = preg_split('/\n#\d+\s/', $entry)[0];
            $detail = preg_replace('/\n\[stacktrace\]\s*$/', '', trim($detail));

            $errors[] = [
                'timestamp' => $m['timestamp'],
                'message'   => trim(explode("\n", $m['message'])[0]),
                'detail'    => trim($detail),
            ];
        }

        return array_slice($errors, -$this->maxEntries);
    }
}
