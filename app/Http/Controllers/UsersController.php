<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function list()
    {
        $list = User::where('is_team', 1)->paginate(5);
        return view("userList", compact('list'));
    }

    public function single(Request $request)
    {
        $item = User::find($request->id);
        dd($item);
        return view("userSingle", compact('item'));
    }
}
