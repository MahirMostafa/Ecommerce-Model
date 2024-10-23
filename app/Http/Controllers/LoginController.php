<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }


    public function loginuser(Request $request)
    {
        // Validate the login request
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // Check if the user exists and the password matches
        if ($user && Hash::check($request->password, $user->password)) {
            // Store user session data
            $request->session()->put('LoginId', $user->id);
            Auth::login($user);

            // Check the usertype and redirect accordingly
            if ($user->usertype === 'admin') {
                return redirect()->intended('dashboard'); // Redirect admins to dashboard
            } else {
                return redirect()->intended('/customer'); // Redirect customers to welcome page
            }
        } else {
            return back()->with('fail', 'Invalid email or password!');
        }
    }



    // public function loginuser(Request $request)
    // {
    //     $validate = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if ($user && Hash::check($request->password, $user->password)) {
    //         $request->session()->put('LoginId', $user->id);
    //         Auth::login($user);
    //         return redirect()->intended('dashboard');
    //     } else {
    //         return back()->with('fail', 'Invalid email or password!');
    //     }
    // }
}
