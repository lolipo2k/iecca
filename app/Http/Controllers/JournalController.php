<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class JournalController extends Controller
{
    public function list(Request $request)
    {
        $list = new Article();
        $list = $list::where('status', 1);
        if ($request->id) $list = $list->where('direction_id', $request->id);
        $list = $list->orderByDesc('id')->paginate(5);

        return view("journalList", compact('list'));
    }

    public function single(Request $request)
    {
        $item = new Article();
        $item = $item::find($request->id);
        $item->count = $item->count + 1;
        $item->save();

        return view("journalSingle", compact('item'));
    }
}
