<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Secure Access</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --gold-primary: #D4AF37;
            --gold-secondary: #FFD700;
            --gold-light: #FFF8DC;
            --black-primary: #121212;
            --black-secondary: #1E1E1E;
            --white-primary: #FFFFFF;
            --gray-light: #F5F5F5;
            --gray-border: #E5E5E5;
        }
        
        body {
            background: var(--black-primary);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .login-container {
            max-width: 440px;
            margin: 0 auto;
        }
        
        .login-card {
            background: var(--white-primary);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.25);
            border: 1px solid rgba(212, 175, 55, 0.1);
        }
        
        .brand-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .brand-logo {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, var(--gold-primary), var(--gold-secondary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: var(--black-primary);
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .brand-name {
            color: var(--black-primary);
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 0.25rem;
        }
        
        .brand-subtitle {
            color: #666;
            font-size: 0.875rem;
            font-weight: 400;
        }
        
        .form-label {
            color: #333;
            font-weight: 500;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            border: 2px solid var(--gray-border);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.9375rem;
            transition: all 0.2s ease;
            background: var(--white-primary);
        }
        
        .form-control:focus {
            border-color: var(--gold-primary);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.15);
            background: var(--white-primary);
        }
        
        .input-group-text {
            background: var(--gray-light);
            border: 2px solid var(--gray-border);
            border-right: none;
            padding: 0.75rem 1rem;
        }
        
        .form-control:focus + .input-group-text {
            border-color: var(--gold-primary);
        }
        
        .btn-login {
            background: var(--black-primary);
            color: var(--white-primary);
            border: none;
            border-radius: 8px;
            padding: 0.875rem;
            font-weight: 600;
            font-size: 0.9375rem;
            width: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-login:hover {
            background: var(--gold-primary);
            color: var(--black-primary);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #999;
            font-size: 0.875rem;
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--gray-border);
        }
        
        .divider span {
            padding: 0 1rem;
        }
        
        .register-link {
            color: var(--black-primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s ease;
        }
        
        .register-link:hover {
            color: var(--gold-primary);
        }
        
        .register-link i {
            margin-left: 0.375rem;
            transition: transform 0.2s ease;
        }
        
        .register-link:hover i {
            transform: translateX(3px);
        }
        
        .alert-danger {
            background: rgba(212, 175, 55, 0.1);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 8px;
            color: var(--black-primary);
            font-size: 0.875rem;
            padding: 0.875rem 1rem;
        }
        
        .text-danger {
            color: #DC3545 !important;
            font-size: 0.8125rem;
            margin-top: 0.375rem;
        }
        
        .form-text {
            color: #666;
            font-size: 0.8125rem;
        }
        
        .footer-text {
            text-align: center;
            margin-top: 1.5rem;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.75rem;
        }
        
        .security-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            color: #666;
            font-size: 0.75rem;
            margin-top: 1rem;
        }
        
        .security-badge i {
            color: var(--gold-primary);
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }
            
            body {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container login-container">
        <div class="login-card">
            <!-- Brand Header -->
            <div class="brand-header">
                <div class="brand-logo">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <h1 class="brand-name">SecureAccess</h1>
                <p class="brand-subtitle">Enterprise Authentication Portal</p>
            </div>

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email Field -->
                <div class="mb-4">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" 
                               class="form-control" 
                               id="email" 
                               name="email"
                               placeholder="name@company.com"
                               value="{{ old('email') }}" 
                               required 
                               autofocus>
                    </div>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label for="password" class="form-label">Password</label>
                        <a href="#" class="text-decoration-none form-text">Forgot password?</a>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" 
                               class="form-control" 
                               id="password" 
                               name="password"
                               placeholder="Enter your password" 
                               required>
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me (Optional) -->
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label form-text" for="remember">
                        Keep me signed in
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-login mb-4">
                    <i class="bi bi-arrow-right me-2"></i>Sign In
                </button>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <div>{{ $errors->first() }}</div>
                        </div>
                    </div>
                @endif

                <!-- Divider -->
                <div class="divider">
                    <span>New to SecureAccess?</span>
                </div>

                <!-- Registration Link -->
                <div class="text-center">
                    <a href="{{ route('register') }}" class="register-link">
                        Create an account
                        <i class="bi bi-arrow-up-right"></i>
                    </a>
                </div>
            </form>

            <!-- Security Badge -->
            <div class="security-badge">
                <i class="bi bi-shield-check"></i>
                <span>256-bit SSL Encryption</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer-text">
            © 2024 SecureAccess. All rights reserved.
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Optional: Form enhancement script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add focus effects to form inputs
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focus');
                });
                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('focus');
                });
            });
            
            // Form submission animation
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('.btn-login');
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Signing in...';
                submitBtn.disabled = true;
            });
        });
    </script>
</body>
</html>