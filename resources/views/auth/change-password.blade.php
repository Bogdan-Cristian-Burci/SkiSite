<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Change Password') }} - {{ config('app.name') }}</title>

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
            padding: 20px 0;
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
            background: rgba(255, 193, 7, 0.9);
            border: 1px solid rgba(255, 193, 7, 0.3);
            color: #856404;
        }

        .alert-warning {
            background: rgba(255, 243, 205, 0.9);
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 5px;
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 10;
        }

        .back-link a {
            display: inline-flex;
            align-items: center;
            padding: 10px 15px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 25px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-link a:hover {
            background: rgba(255, 255, 255, 1);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .back-link a:before {
            content: '←';
            margin-right: 8px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="back-link">
            <a href="{{ url()->previous() }}">{{ __('Back') }}</a>
        </div>
        
        <div class="auth-form">
            <h2>{{ __('Change Password') }}</h2>

            @if (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
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

            <form method="POST" action="{{ route('password.change.update') }}">
                @csrf
                <div class="form-group">
                    <label for="current_password">{{ __('Current Password') }}</label>
                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                           id="current_password" name="current_password" required autocomplete="current-password">
                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">{{ __('New Password') }}</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="password" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input type="password" class="form-control"
                           id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-auth">
                    {{ __('Change Password') }}
                </button>
            </form>

            <div class="auth-link">
                <p><a href="{{ route('dashboard') }}">{{ __('Back to Dashboard') }}</a></p>
            </div>
        </div>
    </div>
</body>
</html>