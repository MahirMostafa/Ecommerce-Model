<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Session;


class DashBoardController extends Controller
{
    public function dashboard()
    {
        if (Session::has('LoginId')) {
            $userId = Session::get('LoginId');
            $user = User::find($userId);
            if ($user) {
                return view('dashboard', ['users' => User::all()]);
            }
        }
        return redirect('/login')->with('error', 'Please log in first.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('edit', ['fetchedUser' => $user]);
    }

    public function updateData($id, Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:10',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ]);


        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return redirect('/dashboard')->with('Success', ' Data Updated!!');
    }

    public function deleteData($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/dashboard')->with('Success', ' Data Deleted!!');
    }
}
