<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\User;
use App\Province;
use App\CityMunicipality;

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
            'address_line_1' => ['required', 'max:60'],
            'address_line_two' => ['nullable', 'max:60']
        ]);

        if($validator->fails()){

            return back()
              ->withErrors($validator)
              ->withInput();

        }

        /*
         * Get province and city/municipality names
         */
        $province = Province::where('provCode', $request['province'])->value('provDesc');
        $municipality = CityMunicipality::where('citymunCode', $request['municipality'])->value('citymunDesc');

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
