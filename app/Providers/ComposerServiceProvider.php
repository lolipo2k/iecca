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
use Illuminate\Support\Collection;

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
            $baners_event = Event::where('onmain', 1)->get();
            $baners_report = Report::where('onmain', 1)->get();
            $baners_content = Content::where('onmain', 1)->get();

            foreach ($baners_event as $value) {
                $value->url = "/event/";
                $value->author_name = "";
            }
            foreach ($baners_report as $value) {
                $value->url = "/report/";
                $value->title_ru = $value->name_ru;
                $value->intro_text_ru = $value->intro_text;
                $value->author_name = ($value->author_name == '') ? $value->user->fullName : $value->author_name;
            }
            foreach ($baners_content as $value) {
                $value->url = "/content/";
                $value->intro_text_ru = $value->text_ru;
                $value->author_name = ($value->author_name == '') ? $value->user->fullName : $value->author_name;
            }


            $c = new Collection;
            $list = $c->merge($baners_event)->merge($baners_report)->merge($baners_content)->sortByDesc('created_at')->limit(5);

            $view->with([
                'articles' => Article::where('status', 1)->orderByDesc('id')->get(),
                'slider' => $list,
                'events' => Banner::all(),
                'tags' => Category::orderByDesc('id')->get(),
                'footer_events' => Event::orderByDesc('id')->limit(4)->get(),
                'statics' => Info::all(),
                'preview' => Event::where('preview', 1)->orderByDesc('id')->first()
            ]);
        });
    }
}
