<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

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
