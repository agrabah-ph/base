<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class WelcomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index() {

        if(User::count()) {
            return view('welcome');
        } else {
            return redirect()->route('register');
        }

    }

    public function volunteer()
    {

        dd($this->validateVolunteer());

    }

    public function contact()
    {
        dd($this->validateContactMessage());
    }

    public function validateContactMessage()
    {
        return request()->validate([

            'contact_firstname' => ['required', 'min:1'],
            'contact_lastname' => ['required', 'min:1'],
            'contact_email' => ['required', 'email'],
            'contact_message' => ['required', 'min:3']

        ]);
    }

    public function validateVolunteer()
    {
        return request()->validate([

            'volunteer_firstname' => ['required', 'min:1'],
            'volunteer_lastname' => ['required', 'min:1'],
            'volunteer_address' => ['required', 'min: 3'],
            'volunteer_email' => ['required', 'email'],
            'volunteer_mobile' => ['required', 'numeric','digits:11'],
            'volunteer-role' => ['required'],
            'agreement' => ['accepted']

        ]);
    }
}
