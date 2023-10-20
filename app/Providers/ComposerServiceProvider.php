<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Article;
use App\Models\Event;
use App\Models\Report;
use App\Models\Content;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Info;

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
                'articles' => Article::where('status', 1)->orderByDesc('id')->get(),
                'baners_event' => Event::where('onmain', 1)->get(),
                'baners_report' => Report::where('onmain', 1)->get(),
                'baners_content' => Content::where('onmain', 1)->get(),
                'events' => Banner::all(),
                'tags' => Category::all(),
                'footer_events' => Event::orderByDesc('id')->limit(4)->get(),
                'statics' => Info::all(),
                'preview' => Event::where('preview', 1)->orderByDesc('id')->first()
            ]);
        });
    }
}
