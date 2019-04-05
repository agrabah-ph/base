<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\SearchUserEvent;
use App\Models\User;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    public function search(Request $request) {
        $query = $request->query('query');
        $rawUsers = User::where('name', 'like', '%'.$query.'%')->get();
        $users = UserResource::collection($rawUsers);

        // event(new SearchUserEvent($users));
        // return response()->json("ok");
        return response()->json($users);
    }

    public function get(Request $request) {
        $users = UserResource::collection(User::all());
        return response()->json($users);
    }
}
