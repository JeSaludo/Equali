<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    function Login()
    {
        return view('auth\login');
    }

    function Authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            //add redirect for admin and users || condition

            if (Auth::user()->role === "Program Head" || Auth::user()->role === "Dean" || Auth::user()->role === "Proctor") {
                return redirect()->route('admin.dashboard.overview');
            } else if (Auth::user()->role === "User") {
                return redirect()->route('home');
            }
            return redirect()->intended('/')->with('status', 'Login Successfull');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function CreateAccountUser(Request $request)
    {
        $validatedData = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = new User();
        $user->first_name = $validatedData['firstName'];
        $user->last_name = $validatedData['lastName'];
        $user->username = substr($validatedData['firstName'], 0, 1) . $validatedData['lastName'];;
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = 'User';
        $user->save();

        return redirect()->route('login.show')->with('status', 'Registration Successfull');
    }

    public function ShowAdminRegistration()
    {
        return view('auth/register');
    }
    public function CreateAccountAdmin(Request $request)
    {

        $validatedData = $request->validate([

            'role' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = new User();
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = $validatedData['role'];
        $user->save();

        return redirect()->route('home')->with('status', 'Registration Successfull');
    }

    public function Logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('status', 'Logout Successfully');
    }
}
