<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; // 1. Wajib import Gate
use App\Models\User; // 2. Import model User

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
        // 3. Definisi Gate untuk mengecek apakah user adalah Admin
        Gate::define('isAdmin', function (User $user) {
            return $user->role === 'admin';
        });

        // (Opsional) Gate untuk mengecek apakah user adalah Petugas
        Gate::define('isPetugas', function (User $user) {
            return $user->role === 'petugas';
        });
    }
}