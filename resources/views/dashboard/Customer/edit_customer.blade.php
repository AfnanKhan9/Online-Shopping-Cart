@extends('Layouts.dashmaster')

@section('categorycreatecontent')
<div class="pd-20 card-box mb-30 bg-dark text-white border border-warning border-2">
    <div class="clearfix mb-20">
        <div class="pull-left">
            <h4 class="h4 text-warning fw-bold"><i class="fa fa-edit me-2"></i>Edit Profile</h4>
        </div>
    </div>

    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label class="text-warning fw-bold mb-2">Full Name</label>
                    <input class="form-control bg-black text-white border-warning focus-ring focus-ring-warning" 
                           type="text" name="name"
                           value="{{ old('name', $customer->name) }}">
                    @error('name')
                        <p class="text-danger mt-1 fw-bold"><i class="fa fa-exclamation-circle me-1"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label class="text-warning fw-bold mb-2">Email Address</label>
                    <input class="form-control bg-black text-white border-warning focus-ring focus-ring-warning" 
                           type="email" name="email"
                           value="{{ old('email', $customer->email) }}">
                    @error('email')
                        <p class="text-danger mt-1 fw-bold"><i class="fa fa-exclamation-circle me-1"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="form-group">
                    <label class="text-warning fw-bold mb-2">Phone Number</label>
                    <input class="form-control bg-black text-white border-warning focus-ring focus-ring-warning" 
                           type="text" name="phone"
                           value="{{ old('phone', $customer->phone) }}">
                    @error('phone')
                        <p class="text-danger mt-1 fw-bold"><i class="fa fa-exclamation-circle me-1"></i>{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-3">
            <div class="form-group">
                <label class="text-warning fw-bold mb-2">Address</label>
                <textarea class="form-control bg-black text-white border-warning focus-ring focus-ring-warning" 
                          name="address" rows="3">{{ old('address', $customer->address) }}</textarea>
                @error('address')
                    <p class="text-danger mt-1 fw-bold"><i class="fa fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>
        </div>

        <hr class="border-warning border-1 opacity-50 my-4">

        <div class="mb-4">
            <div class="form-group">
                <label class="text-warning fw-bold mb-2">New Password <small class="text-white-50">(leave blank to keep current)</small></label>
                <input class="form-control bg-black text-white border-warning focus-ring focus-ring-warning" 
                       type="password" name="password">
                @error('password')
                    <p class="text-danger mt-1 fw-bold"><i class="fa fa-exclamation-circle me-1"></i>{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-warning text-dark fw-bold px-4 py-2 shadow-sm">
                <i class="fa fa-save me-2"></i>Update Profile
            </button>
        </div>
    </form>
</div>

<style>
    /* Custom styles to enhance the theme */
    .bg-black {
        background-color: #111 !important;
    }
    
    .form-control:focus {
        background-color: #111 !important;
        color: #fff !important;
        border-color: #ffc107 !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25) !important;
    }
    
    .border-warning {
        border-color: #ffc107 !important;
    }
    
    .btn-warning:hover {
        background-color: #ffca2c !important;
        border-color: #ffca2c !important;
        color: #000 !important;
    }
</style>
@endsection