<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// Import your models
use App\Models\Admin;
use App\Models\Employee;
use App\Models\Customer;

class AuthController extends Controller
{
    // Show login form
    public function loginForm()
    {
        return view('authorization.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->email;
        $password = $request->password;


        $admin = Admin::where('email', $email)->first();
        if ($admin && $password === $admin->password) {
            Auth::login($admin); // default guard
            return redirect()->route('admin.dashboard');
        }


        $employee = Employee::where('email', $email)->first();
        if ($employee && $password === $employee->password)  {
            Auth::login($employee);
            return redirect()->route('employee.dashboard'); // fixed employee dashboard
        }


        $customer = Customer::where('email', $email)->first();
        if ($customer && $password === $customer->password)  {
            Auth::login($customer);
            return redirect()->route('home');
        }

        // Invalid credentials
        return back()->withErrors(['email'=>'Invalid credentials'])->withInput();
    }

    // Logout
  public function logout(Request $request)
{
    Auth::logout(); // logout user

    $request->session()->invalidate(); // destroy session
    $request->session()->regenerateToken(); // new CSRF token

    return redirect()->route('login');
}


    public function registerForm()
{
    return view('authorization.register');
}

public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:customers,email',
        'password' => 'required',
        'phone' => 'required',
        'address' => 'required',
    ]);

    $customer = Customer::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password, 
        'phone' => $request->phone, 
        'address' => $request->address, 
    ]);


    Auth::login($customer);

    return redirect()->route('login');
}




}
