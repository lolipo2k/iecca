<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function list(Request $request)
    {
        if (!$request->id) {
            $list = new Event();
            $list = $list::where('status', 1)->orderByDesc('id')->paginate(5);
        } else {
            $list = Event::rightJoin('tags_to_news', 'tags_to_news.news_id', '=', 'news.id')
                ->where('news.status', 1)
                ->where('tags_to_news.tag_id', $request->id)
                ->select("news.*")->orderByDesc('news.id')->paginate(5);
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
}
