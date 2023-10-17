<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class HomeController extends Controller
{
    public function __invoke()
    {
        $list = new Event();
        $list = $list::where('status', 1)->limit(10)->get();

        return view("home", compact('list'));
    }
}
