@extends('Layouts.dashmaster')
@section('categorycreatecontent')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Edit Employee</h4>
            </div>
        </div>

        <form action="{{ route('customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Customer Name</label>
                <input class="form-control" type="text" name="name" placeholder="Employee Name"
                    value="{{ $customer->name }}">
                @error('name')
                    <p style="color: red">Name Field Required</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" name="email" placeholder="Employee Email"
                    value="{{ $customer->email }}">
                @error('email')
                    <p style="color: red">Email Field Required</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input class="form-control" type="phone" name="phone" placeholder="Customer Phone"
                    value="{{ $customer->phone }}">
                @error('phone')
                    <p style="color: red">Phone Field Required</p>
                @enderror
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="text" name="password" placeholder="Employee Password"
                    value="{{ $customer->password }}">
                @error('password')
                    <p style="color: red">Password is Required</p>
                @enderror
                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="address" placeholder="Customer Address">{{ $customer->address }}</textarea>
                    @error('address')
                        <p style="color: red">Address is Required</p>
                    @enderror
                </div>

                <button class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
