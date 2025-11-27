@extends('Layouts.dashmaster')
@section('categorycreatecontent')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Edit Employee</h4>
            </div>
        </div>

        <form action="{{ route('employees.update' , $employee->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Employee Name</label>
                <input class="form-control" type="text" name="name" placeholder="Employee Name" value="{{ $employee->name}}">
                @error('name')
                    <p style="color: red">sName Field Required</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" placeholder="Employee Email" value="{{ $employee->email}}">
                @error('email')
                    <p style="color: red">Email Field Required</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="text" name="password" placeholder="Employee Password" value="{{ $employee->password}}">
                @error('password')
                    <p style="color: red">Password is Required</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Roles</label>
                <select class="form-control" name="role" >
                    <option value="Staff">Staff</option>
                    <option value="Manager">Manager</option>
                    <option value="Admin">Admin</option>
                    <option value="Supervisor">Supervisor</option>
                </select>
            </div>

            <button class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
