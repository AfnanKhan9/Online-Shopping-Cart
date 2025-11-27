<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $customer=Customer::all();
        return view('dashboard.Customer.index_customer',compact('customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
       return view('dashboard.Customer.edit_customer', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Customer $customer)
{
     $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'password' => 'required|string',
            'phone' => 'required|string',
        ]);

        $customer->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer Updated Successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
 public function destroy(Customer $customer)
{
    $customer->delete();

    return redirect()->route('customers.index')->with('success', 'Customer Deleted Successfully!');
}

}
