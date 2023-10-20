<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Article;
use App\Models\Event;
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
            $test = Event::join('type', 'news.onmain', '=', 'type.onmain')
                ->join('marticle', 'news.onmain', '=', 'marticle.onmain')
                ->where('news.onmain', 1)->select("*")->get();
            dd($test);
            $view->with([
                'articles' => Article::where('status', 1)->orderByDesc('id')->get(),
                'baners' => Event::join('type', 'news.onmain', '=', 'type.onmain')
                    ->join('marticle', 'marticle.onmain', '=', 'marticle.onmain')
                    ->where('news.onmain', 1)->select("*")->get(),
                'events' => Banner::all(),
                'tags' => Category::all(),
                'footer_events' => Event::orderByDesc('id')->limit(4)->get(),
                'statics' => Info::all(),
                'preview' => Event::where('preview', 1)->orderByDesc('id')->first()
            ]);
        });
    }
}
