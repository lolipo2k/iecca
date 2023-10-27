<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Content;
use App\Models\Category;
use App\Helpers\PaginationHelper;
use Illuminate\Support\Collection;

class EventController extends Controller
{
    public function list(Request $request)
    {
        if (!$request->id) {
            $list = new Event();
            $list = $list::where('status', 1)->orderByDesc('created_at')->paginate(5);
        } else {
            $list = Event::rightJoin('tags_to_news', 'tags_to_news.news_id', '=', 'news.id')
                ->where('news.status', 1)
                ->where('tags_to_news.tag_id', $request->id)
                ->select("news.*")->orderByDesc('news.created_at')->paginate(5);
        }

        return view("eventList", compact('list'));
    }

    public function single(Request $request)
    {
        $item = new Event();
        $item = $item::find($request->id);
        $item->count = $item->count + 1;
        $item->save();

        return view("eventSingle", compact('item'));
    }

    public function material(Request $request)
    {
        $event = Event::rightJoin('tags_to_news', 'tags_to_news.news_id', '=', 'news.id')
            ->where('news.status', 1)
            ->where('tags_to_news.tag_id', $request->id)
            ->select("news.*")->get();

        $content = Content::rightJoin('tags_to_marticles', 'tags_to_marticles.marticle_id', '=', 'marticle.id')
            ->where('marticle.status', 1)
            ->where('tags_to_marticles.tag_id', $request->id)
            ->select("marticle.*")->get();

        foreach ($event as $value) {
            $value->url = "/event/";
        }
        foreach ($content as $value) {
            $value->url = "/content/";
            $value->intro_text_ru = $value->text_ru;
        }

        $category = new Category();
        $category = $category::find($request->id);
        $category->hit = ($category->hit == null || $category->hit == 0) ? 1 : $category->hit + 1;
        $category->save();

        $c = new Collection;
        $list = $c->merge($content)->merge($event)->sortByDesc('created_at');
        $list = PaginationHelper::paginate($list, 10);

        return view("materialList", compact('list'));
    }
}
