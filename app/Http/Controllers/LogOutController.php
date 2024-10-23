<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LogOutController extends Controller
{
    public function logoutUser()
    {
        // Check if the user is logged in
        if (Auth::check()) {
            Auth::logout(); // Log the user out

            // Optional: Clear the session data
            Session::flush();

            // Redirect to login with a success message
            return redirect()->route('login')->with('success', 'User Logged Out Successfully!');
        }

        // If no user is logged in, redirect to login page
        return redirect()->route('login')->with('fail', 'No user was logged in.');
    }
}
