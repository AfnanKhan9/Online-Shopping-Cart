<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            max-width: 420px;
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

        .alert-danger {
            border-radius: 12px;
        }
    </style>
</head>

<body>

<div class="auth-wrapper">
    <div class="auth-card">
        <h3 class="auth-title mb-4 text-center">Welcome Back</h3>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="example@mail.com"
                       value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                @error('password')
                    <p class="text-danger mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-2">Login</button>

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <p class="text-center mt-3">
                <a href="{{ route('register') }}" class="link">Create an Account</a>
            </p>
        </form>

    </div>
</div>

</body>
</html>
