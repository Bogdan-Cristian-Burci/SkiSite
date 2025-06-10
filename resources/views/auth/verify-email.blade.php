<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('Verify Email') }} - {{ config('app.name') }}</title>

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

        .alert-info {
            background: rgba(209, 236, 241, 0.9);
            border: 1px solid rgba(11, 123, 193, 0.3);
            color: #0c5460;
        }

        .description {
            color: #666;
            margin-bottom: 25px;
            text-align: center;
            font-size: 0.9em;
            line-height: 1.5;
        }

        .email-info {
            background: rgba(255, 248, 220, 0.9);
            border: 1px solid rgba(255, 193, 7, 0.3);
            color: #856404;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-form">
            <h2>{{ __('Verify Your Email') }}</h2>
            
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="email-info">
                <strong>{{ __('Email sent to:') }}</strong><br>
                {{ auth()->user()->email }}
            </div>

            <div class="description">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-auth">
                    {{ __('Resend Verification Email') }}
                </button>
            </form>

            <div class="auth-link">
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #007bff; text-decoration: underline; cursor: pointer;">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>