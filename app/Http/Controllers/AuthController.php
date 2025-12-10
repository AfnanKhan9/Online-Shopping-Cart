<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Show login form
    public function loginForm()
    {
        return view('authorization.login'); // login view
    }

    // Handle login
    public function login(Request $request)
    {
        // Validate email and password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // prevent session fixation

            // Redirect to intended URL (checkout or any page) or fallback based on role
            $intended = redirect()->intended('/');

            $role = Auth::user()->role;

            switch ($role) {
                case 'admin':
                    // If intended page is homepage, redirect to admin dashboard
                    return $intended->getTargetUrl() === url('/') ? redirect('/admin') : $intended;
                case 'employee':
                    return $intended->getTargetUrl() === url('/') ? redirect('/employee/dashboard') : $intended;
                case 'customer':
                    return $intended;
                default:
                    Auth::logout();
                    return redirect()->route('login')->withErrors(['role' => 'Invalid role.']);
            }
        }

        // Login failed
        return back()->withErrors([
            'email' => 'Invalid email or password',
        ])->withInput();
    }

    // Show registration form
    public function registerForm()
    {
        return view('authorization.register'); // register view
    }

    // Handle registration
    public function register(Request $request)
    {
        // Validate inputs
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        // Create user with hashed password
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'customer', // default role
        ]);

        Auth::login($user); // auto login

        // Redirect to intended page (checkout) or fallback '/'
        return redirect()->intended('/');
    }

    // Logout user
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
