<?php

namespace App\Providers;

use App\Models\User;
use App\Support\ImageOptimizer;
use Filament\Forms\Components\FileUpload;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Every Filament upload: shrink oversized JPEG/PNG after it is stored (PDFs etc. are skipped).
        FileUpload::configureUsing(fn (FileUpload $upload) => $upload->saveUploadedFileUsing(
            function (FileUpload $component, TemporaryUploadedFile $file): ?string {
                $path = $component->saveUploadedFile($file);

                if ($path) {
                    $disk = $component->getDisk();
                    $final = rescue(fn () => ImageOptimizer::optimize($disk->path($path), pngToJpeg: true));

                    // Converted PNG -> JPG: the stored path must follow the new extension.
                    if ($final && $final !== $disk->path($path)) {
                        $path = preg_replace('/\.png$/i', '.jpg', $path);
                    }
                }

                return $path;
            }
        ));

        Event::listen(Login::class, function (Login $event): void {
            if (! $event->user instanceof User) {
                return;
            }

            activity()
                ->causedBy($event->user)
                ->event('login')
                ->withProperties(['ip' => request()->ip()])
                ->log('Login berhasil');
        });

        Event::listen(Logout::class, function (Logout $event): void {
            if (! $event->user instanceof User) {
                return;
            }

            activity()
                ->causedBy($event->user)
                ->event('logout')
                ->withProperties(['ip' => request()->ip()])
                ->log('Logout');
        });

        Event::listen(Failed::class, function (Failed $event): void {
            activity()
                ->event('login_failed')
                ->withProperties([
                    'ip'    => request()->ip(),
                    'email' => $event->credentials['email'] ?? null,
                ])
                ->log('Percobaan login gagal');
        });
    }
}
