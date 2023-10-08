<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function list(Request $request)
    {
        $list = new Event();
        $list = $list::where('status', 1);
        if ($request->id) $list = $list->where('project_id', $request->id);
        $list = $list->paginate(5);

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
