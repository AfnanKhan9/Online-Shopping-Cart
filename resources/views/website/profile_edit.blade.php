@extends('Layouts.webmaster')

@section('editprofile')
<div class="container-fluid p-0 ">
    <!-- Full-width header section -->
<div class="bg-warning py-3 px-4 shadow-sm "  style="top:0; z-index:1030;">


        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="h4 text-dark fw-bold mb-0">
                    <i class="fas fa-user-edit me-2"></i>Edit Profile
                </h4>
                <p class="text-dark mb-0 small">Update your personal information and password</p>
            </div>
            <a href="{{ url()->previous() }}" class="btn btn-dark btn-sm">
                <i class="fas fa-arrow-left me-1"></i>Back
            </a>
        </div>
    </div>

    <!-- Main content area - touches both sides -->
    <div class="bg-white min-vh-100 py-4">
        <div class="container-fluid px-4">
            <form action="{{ route('customer.profile.update', $customer->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-12 col-md-8 col-lg-6 mx-auto">
                        <!-- Personal Information Card -->
                        <div class="card border-warning border-2 shadow-sm mb-4">
                            <div class="card-header bg-white border-warning border-bottom-2 py-3">
                                <h5 class="card-title text-dark fw-bold mb-0">
                                    <i class="fas fa-id-card text-warning me-2"></i>Personal Information
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label text-dark fw-semibold mb-2">
                                                <i class="fas fa-user text-warning me-2"></i>Full Name
                                            </label>
                                            <input class="form-control border-warning border-2" 
                                                   type="text" name="name"
                                                   value="{{ old('name', $customer->name) }}"
                                                   required>
                                            <div class="form-text text-muted">Your full legal name</div>
                                            @error('name')
                                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                                    <i class="fas fa-exclamation-triangle me-2"></i>{{ $message }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label text-dark fw-semibold mb-2">
                                                <i class="fas fa-envelope text-warning me-2"></i>Email Address
                                            </label>
                                            <input class="form-control border-warning border-2" 
                                                   type="email" name="email"
                                                   value="{{ old('email', $customer->email) }}"
                                                   required>
                                            <div class="form-text text-muted">We'll never share your email</div>
                                            @error('email')
                                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                                    <i class="fas fa-exclamation-triangle me-2"></i>{{ $message }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label text-dark fw-semibold mb-2">
                                                <i class="fas fa-phone text-warning me-2"></i>Phone Number
                                            </label>
                                            <input class="form-control border-warning border-2" 
                                                   type="tel" name="phone"
                                                   value="{{ old('phone', $customer->phone) }}">
                                            <div class="form-text text-muted">Include country code if applicable</div>
                                            @error('phone')
                                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                                    <i class="fas fa-exclamation-triangle me-2"></i>{{ $message }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label text-dark fw-semibold mb-2">
                                                <i class="fas fa-map-marker-alt text-warning me-2"></i>Address
                                            </label>
                                            <textarea class="form-control border-warning border-2" 
                                                      name="address" rows="3"
                                                      style="min-height: 48px;">{{ old('address', $customer->address) }}</textarea>
                                            <div class="form-text text-muted">Your complete postal address</div>
                                            @error('address')
                                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                                    <i class="fas fa-exclamation-triangle me-2"></i>{{ $message }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Password Update Card -->
                        <div class="card border-warning border-2 shadow-sm mb-4">
                            <div class="card-header bg-white border-warning border-bottom-2 py-3">
                                <h5 class="card-title text-dark fw-bold mb-0">
                                    <i class="fas fa-key text-warning me-2"></i>Password Update
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label text-dark fw-semibold mb-2">New Password</label>
                                            <input class="form-control border-warning border-2" 
                                                   type="password" name="password"
                                                   placeholder="Enter new password">
                                            <div class="form-text text-muted">Minimum 8 characters</div>
                                            @error('password')
                                                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                                    <i class="fas fa-exclamation-triangle me-2"></i>{{ $message }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label class="form-label text-dark fw-semibold mb-2">Confirm Password</label>
                                            <input class="form-control border-warning border-2" 
                                                   type="password" name="password_confirmation"
                                                   placeholder="Confirm new password">
                                            <div class="form-text text-muted">Leave blank to keep current password</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center bg-light p-4 rounded border border-warning">
                            <div>
                                <p class="text-muted small mb-0">
                                    <i class="fas fa-info-circle text-warning me-1"></i>
                                    Click "Update Profile" to save changes
                                </p>
                            </div>
                            <button type="submit" class="btn btn-warning fw-bold px-5 py-2 shadow">
                                <i class="fas fa-save me-2"></i>Update Profile
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Full-width styling */
    .container-fluid {
        max-width: 100%;
    }
    
    /* Remove default margins */
    body {
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
    }
    
    /* Ensure content touches navbar */
    .min-vh-100 {
        min-height: calc(100vh - 73px); /* Adjust based on navbar height */
    }
    
    /* Enhanced form styling */
    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
        background-color: #fff;
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #ffc107 0%, #ffca2c 100%);
        border: none;
        transition: all 0.3s ease;
    }
    
    .btn-warning:hover {
        background: linear-gradient(135deg, #ffca2c 0%, #ffc107 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4) !important;
    }
    
    .btn-dark:hover {
        background-color: #343a40;
        color: white;
    }
    
    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c2c7;
        color: #842029;
        border-radius: 8px;
    }
    
    .card {
        transition: transform 0.2s;
        border-radius: 12px;
    }
    
    .card:hover {
        transform: translateY(-3px);
    }
    
    .border-warning {
        border-color: #ffc107 !important;
    }
    
    .border-bottom-2 {
        border-bottom-width: 2px !important;
    }
    
    /* Header styling */
    .bg-warning {
        background: linear-gradient(to right, #ffc107, #ffdb70) !important;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .px-4 {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
        
        .py-3 {
            padding-top: 0.75rem !important;
            padding-bottom: 0.75rem !important;
        }
        
        .col-12 {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
    }
</style>

<script>
    // Form validation
    (function () {
        'use strict'
        
        var forms = document.querySelectorAll('.needs-validation')
        
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    
                    form.classList.add('was-validated')
                }, false)
            })
    })()
    
    // Auto-dismiss alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        var alerts = document.querySelectorAll('.alert-dismissible');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                var closeBtn = alert.querySelector('.btn-close');
                if (closeBtn) {
                    closeBtn.click();
                }
            }, 5000);
        });
    });
</script>
@endsection