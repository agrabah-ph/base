<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

    protected function validateVolunteer()
    {
        return request()->validate([

            'firstname' => ['required', 'min:1'],
            'lastname' => ['required', 'min:1'],
            'address' => ['required', 'min: 3'],
            'volunteer_email' => ['required', 'email'],
            'mobile' => ['required', 'numeric','digits:11'],
            'volunteer-role' => ['required'],
            'agreement' => ['accepted']

        ]);
    }

    protected function validateContactMessage()
    {
        return request()->validate([

            'firstname' => ['required', 'min:1'],
            'lastname' => ['required', 'min:1'],
            'email' => ['required', 'email'],
            'message' => ['required', 'min: 3', 'max: 399']

        ]);
    }
}
