<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Content;
use App\Models\Report;

class HomeController extends Controller
{
    public function __invoke()
    {
        $baners_event = Event::where('onmain', 1)->get();
        $baners_report = Report::where('onmain', 1)->get();
        $baners_content = Content::where('onmain', 1)->get();

        return view("home", compact('baners_event', 'baners_report', 'baners_content'));
    }
}
