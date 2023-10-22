<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Content;
use App\Models\Report;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    public function __invoke()
    {
        $baners_event = Event::where('onmain', 1)->get();
        $baners_report = Report::where('onmain', 1)->get();
        $baners_content = Content::where('onmain', 1)->get();

        foreach ($baners_event as $value) {
            $value->url = "/event/";
        }
        foreach ($baners_report as $value) {
            $value->url = "/report/";
            $value->title_ru = $value->name_ru;
        }
        foreach ($baners_content as $value) {
            $value->url = "/content/";
        }


        $c = new Collection;
        $list = $c->merge($baners_event)->merge($baners_report)->merge($baners_content)->sortByDesc('created_at')->slice(0, 10);

        return view("home", compact('list'));
    }
}
