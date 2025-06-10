<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Forgot Password') }} - {{ config('app.name') }}</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        .auth-wrapper {
            min-height: 100vh;
            background: url('{{ asset('images/about-2.jpg') }}') center/cover no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .auth-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        .auth-form {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            max-width: 450px;
            width: 100%;
            margin: 20px;
            position: relative;
            z-index: 2;
            border: 1px solid rgba(255, 255, 255, 0.2);
            opacity:0.8;
        }

        .auth-form h2 {
            color: #333;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            color: #555;
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
        }

        .form-control {
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            background: rgba(255, 255, 255, 1);
        }

        .btn-auth {
            background: linear-gradient(135deg, #007bff, #0056b3);
            border: none;
            border-radius: 12px;
            padding: 12px 24px;
            width: 100%;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.3);
            background: linear-gradient(135deg, #0056b3, #004085);
        }

        .auth-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        .auth-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }

        .auth-link a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: rgba(212, 237, 218, 0.9);
            border: 1px solid rgba(25, 135, 84, 0.3);
            color: #155724;
        }

        .alert-danger {
            background: rgba(248, 215, 218, 0.9);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: #721c24;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 5px;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .description {
            color: #666;
            margin-bottom: 25px;
            text-align: center;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-form">
            <h2>{{ __('Forgot Password') }}</h2>
            
            <div class="description">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label for="email">{{ __('Email Address') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-auth">
                    {{ __('Email Password Reset Link') }}
                </button>
            </form>

            <div class="auth-link">
                <p><a href="{{ route('login') }}">{{ __('Back to Login') }}</a></p>
            </div>
        </div>
    </div>
</body>
</html>