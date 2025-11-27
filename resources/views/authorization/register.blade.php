<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f2f4f7;
            font-family: "Poppins", sans-serif;
        }

        .auth-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .auth-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px 35px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 460px;
            transition: 0.3s;
        }

        .auth-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }

        .auth-title {
            font-weight: 700;
            font-size: 28px;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px;
        }

        .btn-primary {
            border-radius: 12px;
            padding: 12px;
            width: 100%;
            font-weight: 600;
        }

        .link {
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>

<body>

<div class="auth-wrapper">
    <div class="auth-card">
        <h3 class="auth-title text-center mb-4">Create Account</h3>

        <!-- FIXED FORM -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-2">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" placeholder="John Doe" required name="name">
            </div>

            <div class="mb-2">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="example@mail.com" required name="email">
            </div>

              <div class="mb-2">
                <label class="form-label">Phone</label>
                <input type="phone" class="form-control" placeholder="+098" required name="phone">
            </div>


            <div class="mb-2">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="••••••••" required name="password">
            </div>

               <div class="mb-2">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" placeholder="+098" required name="address">
            </div>

            <button class="btn btn-primary" type="submit">Register</button>

            <!-- Error Message -->
            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <p class="text-center mt-3">
                <a href="{{ route('login') }}" class="link">Already have an account? Login</a>
            </p>

        </form>
    </div>
</div>

</body>
</html>
