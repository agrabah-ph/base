<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class WelcomeController extends Controller
{
    public function index() {
        if(User::count()) {
            return view('welcome');
        } else {
            return redirect()->route('register');
        }
    }
}
