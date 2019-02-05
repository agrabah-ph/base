<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function purchaseorders()
    {
        return view('purchaseorders');
    }

    public function users()
    {
        return view('owner.users');
    }

    public function notifications()
    {
        return view('notifications');
    }

    public function profile()
    {
        return view('profile');
    }

    public function activityLogs()
    {
        $loginActivities = \App\LoginActivity::whereUserId(auth()->user()->id)->latest()->get();
        return view('activitylogs', compact('loginActivities'));
    }
}
