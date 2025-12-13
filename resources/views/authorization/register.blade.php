<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Secure Access</title>
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
            --gray-text: #666666;
        }
        
        body {
            background: var(--black-primary);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .register-container {
            max-width: 480px;
            margin: 0 auto;
        }
        
        .register-card {
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
            color: var(--gray-text);
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
        
        .btn-register {
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
        
        .btn-register:hover {
            background: var(--gold-primary);
            color: var(--black-primary);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.3);
        }
        
        .btn-register:active {
            transform: translateY(0);
        }
        
        .password-strength {
            height: 4px;
            background: var(--gray-border);
            border-radius: 2px;
            margin-top: 0.5rem;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease;
            border-radius: 2px;
        }
        
        .password-requirements {
            font-size: 0.75rem;
            color: var(--gray-text);
            margin-top: 0.5rem;
        }
        
        .password-requirements ul {
            padding-left: 1rem;
            margin-bottom: 0;
        }
        
        .password-requirements li {
            margin-bottom: 0.25rem;
        }
        
        .password-requirements li.valid {
            color: #28a745;
        }
        
        .password-requirements li.valid::before {
            content: "✓ ";
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
        
        .login-link {
            color: var(--black-primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            transition: all 0.2s ease;
        }
        
        .login-link:hover {
            color: var(--gold-primary);
        }
        
        .login-link i {
            margin-left: 0.375rem;
            transition: transform 0.2s ease;
        }
        
        .login-link:hover i {
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
            color: var(--gray-text);
            font-size: 0.8125rem;
        }
        
        .footer-text {
            text-align: center;
            margin-top: 1.5rem;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.75rem;
        }
        
        .terms-check {
            font-size: 0.8125rem;
        }
        
        .terms-check a {
            color: var(--gold-primary);
            text-decoration: none;
        }
        
        .terms-check a:hover {
            text-decoration: underline;
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .register-card {
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
    <div class="container register-container">
        <div class="register-card">
            <!-- Brand Header -->
            <div class="brand-header">
                <div class="brand-logo">
                    <i class="bi bi-person-plus"></i>
                </div>
                <h1 class="brand-name">Join SecureAccess</h1>
                <p class="brand-subtitle">Create your professional account</p>
            </div>

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Full Name Field -->
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" 
                               class="form-control" 
                               name="name"
                               placeholder="John Doe"
                               required>
                    </div>
                </div>

                <!-- Email Field -->
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" 
                               class="form-control" 
                               name="email"
                               placeholder="name@company.com"
                               required>
                    </div>
                </div>

                <!-- Phone Field -->
                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-telephone"></i>
                        </span>
                        <input type="tel" 
                               class="form-control" 
                               name="phone"
                               placeholder="+1 (555) 123-4567"
                               required>
                    </div>
                    <div class="form-text">Include country code</div>
                </div>

                <!-- Address Field -->
                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-geo-alt"></i>
                        </span>
                        <input type="text" 
                               class="form-control" 
                               name="address"
                               placeholder="123 Main St, City, Country"
                               required>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" 
                               class="form-control" 
                               name="password"
                               placeholder="Create a strong password"
                               required
                               id="passwordInput">
                    </div>
                    <div class="password-strength">
                        <div class="password-strength-bar" id="passwordStrength"></div>
                    </div>
                    <div class="password-requirements" id="passwordRequirements">
                        <ul class="mb-0">
                            <li id="reqLength">At least 8 characters</li>
                            <li id="reqUppercase">One uppercase letter</li>
                            <li id="reqLowercase">One lowercase letter</li>
                            <li id="reqNumber">One number</li>
                            <li id="reqSpecial">One special character</li>
                        </ul>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                    <label class="form-check-label terms-check" for="terms">
                        I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-register mb-3">
                    <i class="bi bi-person-plus me-2"></i>Create Account
                </button>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <div>{{ $errors->first() }}</div>
                        </div>
                    </div>
                @endif

                <!-- Divider -->
                <div class="divider">
                    <span>Already have an account?</span>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <a href="{{ route('login') }}" class="login-link">
                        Sign in to your account
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </form>

            <!-- Security Note -->
            <div class="security-badge mt-3">
                <i class="bi bi-shield-check text-success"></i>
                <span class="form-text">Your data is protected with enterprise-grade security</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer-text">
            © 2024 SecureAccess. All rights reserved.
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Password Strength Indicator -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('passwordInput');
            const strengthBar = document.getElementById('passwordStrength');
            const requirements = {
                length: document.getElementById('reqLength'),
                uppercase: document.getElementById('reqUppercase'),
                lowercase: document.getElementById('reqLowercase'),
                number: document.getElementById('reqNumber'),
                special: document.getElementById('reqSpecial')
            };

            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                let totalChecks = 0;
                let passedChecks = 0;

                // Check length
                if (password.length >= 8) {
                    requirements.length.classList.add('valid');
                    strength += 20;
                    passedChecks++;
                } else {
                    requirements.length.classList.remove('valid');
                }
                totalChecks++;

                // Check uppercase
                if (/[A-Z]/.test(password)) {
                    requirements.uppercase.classList.add('valid');
                    strength += 20;
                    passedChecks++;
                } else {
                    requirements.uppercase.classList.remove('valid');
                }
                totalChecks++;

                // Check lowercase
                if (/[a-z]/.test(password)) {
                    requirements.lowercase.classList.add('valid');
                    strength += 20;
                    passedChecks++;
                } else {
                    requirements.lowercase.classList.remove('valid');
                }
                totalChecks++;

                // Check numbers
                if (/[0-9]/.test(password)) {
                    requirements.number.classList.add('valid');
                    strength += 20;
                    passedChecks++;
                } else {
                    requirements.number.classList.remove('valid');
                }
                totalChecks++;

                // Check special characters
                if (/[^A-Za-z0-9]/.test(password)) {
                    requirements.special.classList.add('valid');
                    strength += 20;
                    passedChecks++;
                } else {
                    requirements.special.classList.remove('valid');
                }
                totalChecks++;

                // Update strength bar
                strengthBar.style.width = strength + '%';
                
                // Color coding
                if (strength <= 40) {
                    strengthBar.style.backgroundColor = '#dc3545'; // Red
                } else if (strength <= 80) {
                    strengthBar.style.backgroundColor = '#ffc107'; // Yellow
                } else {
                    strengthBar.style.backgroundColor = '#28a745'; // Green
                }
            });

            // Form submission animation
            const form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('.btn-register');
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Creating account...';
                submitBtn.disabled = true;
            });

            // Phone number formatting
            const phoneInput = document.querySelector('input[name="phone"]');
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 0) {
                    value = '+' + value;
                }
                e.target.value = value;
            });
        });
    </script>
</body>
</html>