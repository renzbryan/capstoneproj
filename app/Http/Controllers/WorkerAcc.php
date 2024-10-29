<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerAcc extends Controller
{
    /**
     * Display the worker account page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('workeracc');
    }

    /**
     * Display the registration form or handle the registration process.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function register(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('registerworker');
        }

        if ($request->isMethod('post')) {
            // Validate the registration input
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:workers',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Create and save a new worker
            $worker = new Worker([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'fcm_token' => null,
            ]);

            $worker->save();

            return redirect('/worker');
        }
    }

    /**
     * Log out the current worker and redirect to the homepage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
