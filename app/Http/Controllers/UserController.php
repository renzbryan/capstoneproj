<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display the authenticated user's homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        return view('user.homepage', compact('user'));
    }

    /**
     * Show the settings page for the authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function viewSetting()
    {
        return view('user.setting');
    }
}
