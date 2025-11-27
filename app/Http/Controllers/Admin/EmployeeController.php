<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee=Employee::all();
        return view('dashboard.Employee.index_employee',compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        return view('dashboard.Employee.create_employee');
    }

    
    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    // Validate input
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:employees',
        'password' => 'required',
        'role'     => 'required|string',
    ]);

    // Insert into database
    Employee::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => $request->password,
        'role'     => $request->role,
    ]);

    return redirect()->route('employees.index')->with('success', 'Employee Added Successfully!');
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
     public function edit(Employee $employee)
{
    return view('dashboard.Employee.edit_employee', compact('employee'));
}

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Employee $employee)
{
     $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email',
            'password' => 'nullable',
            'role'     => 'required|string',
        ]);

        $employee->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'role'     => $request->role,
        ]);

        return redirect()->route('employees.index')->with('success', 'Employee Updated Successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
         return redirect()->route('employees.index')->with('success', 'Employee Deleted Successfully!');
    }
}
