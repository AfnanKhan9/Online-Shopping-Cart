@extends('Layouts.dashmaster')
@section('categorycreatecontent')
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Add Employee/Admin</h4>
        </div>
    </div>

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label>Employee Name</label>
            <input class="form-control" type="text" name="name" placeholder="Employee Name" value="{{ old('name') }}">
            @error('name')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label>Email</label>
            <input class="form-control" type="email" name="email" placeholder="Employee Email" value="{{ old('email') }}">
            @error('email')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label>Password</label>
            <input class="form-control" type="password" name="password" placeholder="Employee Password">
            @error('password')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label>Confirm Password</label>
            <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password">
        </div>

        <div class="form-group mb-3">
            <label>Role</label>
            <select name="role" class="form-control">
                <option value="employee">Employee</option>
                <option value="admin">Admin</option>
            </select>
            @error('role')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Add Employee/Admin</button>
    </form>
</div>
@endsection
