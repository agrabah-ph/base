<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\SearchUserEvent;
use App\User;

class UserController extends Controller
{
    public function search(Request $request) {
        $query = $request->query('query');
        $users = User::where('name', 'like', '%'.$query.'%')->get();

        // event(new SearchUserEvent($users));
        // return response()->json("ok");
        return response()->json($users);
    }

    public function get(Request $request) {
        $users = User::all();
        return response()->json($users);
    }
}
