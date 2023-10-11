<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Raiting;

class RaitingController extends Controller
{
    public function raiting(Request $request)
    {
        $raiting = new Raiting();
        $raiting->raiting = $request->raiting;
        if ($request->type == 'journal') {
            $raiting->journal_id = $request->id;
        } else {
            $raiting->event_id = $request->id;
        }
        $raiting->save();
    }
}
