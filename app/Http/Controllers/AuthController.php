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

            // Redirect based on role
            $role = Auth::user()->role;

            switch ($role) {
                case 'admin':
                    return redirect('/admin'); // admin dashboard
                case 'employee':
                    return redirect('/employee/dashboard'); // employee dashboard
                case 'customer':
                    return redirect('/'); // customer main page
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
    // Validate inputs (without password confirmation)
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6', // no confirmed rule
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:255',
        // 'role' => 'required|in:admin,employee,customer'
    ]);

    // Create user with hashed password
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // always hash
        'phone' => $request->phone,
        'address' => $request->address,
        // 'role' => $request->role,
    ]);

    Auth::login($user); // auto login

    // Redirect based on role
    switch ($user->role) {
        case 'admin':
            return redirect('/admin');
        case 'employee':
            return redirect('/employee/dashboard');
        case 'customer':
            return redirect('/');
        default:
            Auth::logout();
            return redirect()->route('login')->withErrors(['role' => 'Invalid role.']);
    }
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
