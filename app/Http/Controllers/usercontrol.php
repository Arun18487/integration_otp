<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class usercontrol extends Controller
{

    public function signup()
    {
        return view('signup');
    }
    public function login()
    {
        return view('login');
    }
    public function userstore(Request $request)
    {
       $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6',
        'password_confirmation' => 'required|min:6',
       ]);
       $user = new User();  
       $user->name = $request->name;
       $user->email = $request->email;
       $user->password = bcrypt($request->password);
       $user->save();
       return redirect()->route('login')->with('success', 'User created successfully');
    }

 

public function userlogin(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();
    

    if (!$user || !Hash::check($request->password, $user->password)) {
        return back()->with('error', 'Invalid credentials');
    }

    Auth::login($user);
    return redirect()->route('dashboard');
}

    public function user()
    {
        $user = User::all();
        return response()->json($user);
    }
    public function userlogout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function dashboard()
    {
        return view('dashboard');
    }
}
