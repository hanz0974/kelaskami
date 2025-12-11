<?php

namespace App\Providers;

use App\Models\matakuliah;
use App\Models\User;
use Illuminate\Support\Facades\View;
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
        //
        // Share `matakuliah` with all views so layout/components don't get undefined variable errors.
        // Use a composer to avoid calling the DB when running certain CLI tasks.
        View::composer('*', function ($view) {
            // Safely attempt to fetch matakuliah; in some CLI contexts the DB may not be available.
            try {
                $matakuliah = matakuliah::all();
            } catch (\Throwable $e) {
                $matakuliah = collect();
            }

            $view->with('matakuliah', $matakuliah);
        });
        View::composer('components.navbar', function ($view) {
            $mahasiswaUsers = User::where('role', 'mahasiswa')->get();
            $view->with('mahasiswa', $mahasiswaUsers);
        });

    }
}
