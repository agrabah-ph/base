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
        dd($this->validateContacts());
    }

    public function validateContacts()
    {
        return request()->validate([

            'contact_firstname' => ['required', 'min:1', 'max:50','string'],
            'contact_lastname' => ['required', 'min:1', 'max:50', 'string'],
            'contact_email' => ['required', 'email', 'max:50'],
            'contact_message' => ['required', 'min:3', 'max:220', 'string']

        ]);
    }

    public function validateVolunteer()
    {
        return request()->validate([

            'volunteer_firstname' => ['required', 'min:1', 'max:50', 'string'],
            'volunteer_lastname' => ['required', 'min:1','max:50', 'string'],
            'volunteer_address' => ['required', 'min: 3','max:300', 'string'],
            'volunteer_email' => ['required', 'email', 'max:50'],
            'volunteer_mobile' => ['required', 'numeric','digits:11'],
            'volunteer-role' => ['required'],
            'agreement' => ['accepted']

        ]);
    }
}
