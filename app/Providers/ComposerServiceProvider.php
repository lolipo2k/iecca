<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Direction;
use App\Models\Event;
use App\Models\Banner;
use App\Models\Category;

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

        View::composer(['layouts.default'], function ($view) {
            $view->with([
                'journal' => Direction::all(), 'baner' => Event::all()->random(1)->first(), 'events' => Banner::all(),
                'tags' => Category::all(), 'footer_events' => Event::orderByDesc('id')->limit(4)->get()
            ]);
        });
    }
}
