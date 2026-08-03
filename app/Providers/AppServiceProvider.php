<?php

namespace App\Providers;

use App\Models\Contact;
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
        View::composer('layouts.navigation', function ($view) {
            $unreadMessagesCount = auth()->user()?->isAdmin()
                ? Contact::where('is_read', false)->count()
                : 0;

            $view->with('unreadMessagesCount', $unreadMessagesCount);
        });
    }
}
