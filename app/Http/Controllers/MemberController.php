<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\User;

class MemberController extends Controller
{
    public function __construct() {
        $this->middleware(['role:owner']);
    }

    public function showRegistrationForm() {
        return view('/owner/users-add');
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required',
                Rule::in(['owner', 'client', 'vendor', 'mod']),
            ],
        ]);

        if($validator->fails()){
            return back()
              ->withErrors($validator)
              ->withInput();
        }

        $password = User::generatePassword();
        $role = $request['role'];

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $password,
        ]);

        $user->assignRole($role);

        User::sendWelcomeEmail($user);

        return redirect('/users');
    }
}
