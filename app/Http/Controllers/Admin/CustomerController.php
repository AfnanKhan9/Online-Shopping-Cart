<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')->get();

        return view('dashboard.Customer.index_customer', compact('customers'));
    }

    public function editProfile()
    {
        $customer = auth()->user(); // logged-in customer
        $allCategories = Category::all();
        return view('website.profile_edit', compact('customer','allCategories'));
    }

    // Customer updates own profile (frontend)
    // Customer updates own profile (frontend)
public function updateProfile(Request $request)
{
    $customer = auth()->user();

    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email',
        'phone'    => 'required|string',
        'address'  => 'nullable|string',
        'password' => 'nullable|min:6',
    ]);

    // Update customer info
    $customer->update([
        'name'    => $request->name,
        'email'   => $request->email,
        'phone'   => $request->phone,
        'address' => $request->address,
    ]);

    // Update password if provided
    if ($request->filled('password')) {
        $customer->password = Hash::make($request->password);
        $customer->save();
    }

    // Logout customer
    auth()->logout();

    // Redirect to login page with success message
    return redirect()->route('login')->with('success', 'Profile updated successfully. Please login again.');
}

    

    public function destroy(User $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')
            ->with('success', 'Customer Deleted Successfully!');
    }
}
