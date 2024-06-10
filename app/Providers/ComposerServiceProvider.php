<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Categories;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('layouts.site_layout', function ($view) {
            $view->with([
                'categories_in_nav' => Categories::where('is_show_in_nav', 1)->get(),
                'count_cart' => Cart::where('id_user', \Auth::id())->sum('quantity'),
            ]);
        });
    }
}
