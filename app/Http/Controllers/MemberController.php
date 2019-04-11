<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\User;
use App\UserAddress;

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
            'province' => ['required', 'string', 'max:12'],
            'municipality' => ['required', 'string', 'max:12'],
            'barangay' => ['required', 'string', 'max:40'],
            'address_line' => ['required', 'max:60'],
            'address_line_two' => ['nullable', 'max:60'],
            'lat' => ['required', 'string'],
            'lng' => ['required', 'string']
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

        $userAddress = UserAddress::create([
            'user_id' => $user->id,
            'provCode' => $request['province'],
            'citymunCode' => $request['municipality'],
            'brgyCode' => $request['barangay'],
            'address_line' => $request['address_line'],
            'lat' => $request['lat'],
            'lng' => $request['lng']
        ]);

        User::sendWelcomeEmail($user);

        return redirect('/users');
    }
}
