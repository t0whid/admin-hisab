<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Log In | Shahjalal Enterprise</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Existing theme icons/css if zmdi icon is needed --}}
    <link rel="stylesheet" href="{{ asset('assets/backend/css/style.min.css') }}">

    <style>
        :root {
            --primary: #7c3aed;
            --secondary: #ec4899;
            --dark: #111827;
            --muted: #6b7280;
            --border: #e5e7eb;
            --soft: #f8fafc;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: Inter, Arial, Helvetica, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(124, 58, 237, 0.13), transparent 34%),
                radial-gradient(circle at bottom right, rgba(236, 72, 153, 0.11), transparent 30%),
                linear-gradient(135deg, #f8fafc 0%, #eef2ff 50%, #fff7ed 100%);
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 32px 0;
        }

        .login-card {
            border: 0;
            border-radius: 30px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 30px 80px rgba(15, 23, 42, 0.16);
        }

        .login-form-area {
            min-height: 620px;
            padding: 54px 48px 34px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand-area {
            text-align: center;
            margin-bottom: 34px;
        }

        .brand-logo {
            width: 74px;
            height: 74px;
            object-fit: contain;
            margin-bottom: 18px;
        }

        .brand-area h4 {
            color: var(--dark);
            font-size: 26px;
            font-weight: 850;
            letter-spacing: -0.4px;
            margin-bottom: 8px;
        }

        .brand-area p {
            color: var(--muted);
            font-size: 14px;
            margin-bottom: 0;
        }

        .form-label {
            color: #374151;
            font-size: 14px;
            font-weight: 750;
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap .form-control {
            height: 54px;
            border-radius: 16px;
            border: 1px solid #dfe5ef;
            background: #fbfcff;
            padding-left: 48px;
            padding-right: 48px;
            font-size: 14px;
            color: var(--dark);
            transition: all 0.2s ease;
        }

        .input-wrap .form-control::placeholder {
            color: #9ca3af;
        }

        .input-wrap .form-control:focus {
            border-color: var(--primary);
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.12);
        }

        .input-icon {
            position: absolute;
            left: 17px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            z-index: 2;
            font-size: 18px;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #94a3b8;
            z-index: 3;
            font-size: 20px;
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }

        .password-toggle:hover {
            color: var(--primary);
        }

        .btn-login {
            height: 54px;
            border: 0;
            border-radius: 16px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #ffffff;
            font-weight: 850;
            letter-spacing: 0.4px;
            box-shadow: 0 16px 32px rgba(124, 58, 237, 0.26);
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 20px 40px rgba(124, 58, 237, 0.34);
        }

        .divider-line {
            height: 1px;
            background: #eef2f7;
            margin: 26px 0 18px;
        }

        .login-footer {
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.7;
        }

        .login-footer a {
            color: var(--primary);
            font-weight: 750;
            text-decoration: none;
        }

        .login-footer a:hover {
            color: var(--secondary);
            text-decoration: underline;
        }

        .developer-line {
            margin-top: 4px;
            color: #64748b;
        }

        .developer-line strong {
            color: #111827;
            font-weight: 850;
        }

        .developer-contact {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 2px;
        }

        .developer-contact span {
            color: #cbd5e1;
        }

        .side-panel {
            min-height: 620px;
            height: 100%;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 54px;
            background:
                radial-gradient(circle at top right, rgba(255, 255, 255, 0.18), transparent 30%),
                radial-gradient(circle at bottom left, rgba(255, 255, 255, 0.13), transparent 28%),
                linear-gradient(135deg, #7c3aed 0%, #9333ea 38%, #ec4899 100%);
        }

        .side-panel::before {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.11);
            top: -100px;
            right: -80px;
        }

        .side-panel::after {
            content: "";
            position: absolute;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.10);
            bottom: -90px;
            left: -80px;
        }

        .side-content {
            position: relative;
            z-index: 2;
            color: #ffffff;
            text-align: center;
            max-width: 520px;
        }

        .side-content img {
            width: 100%;
            max-width: 390px;
            margin-bottom: 34px;
            filter: drop-shadow(0 18px 28px rgba(15, 23, 42, 0.12));
        }

        .side-content h3 {
            font-size: 30px;
            font-weight: 850;
            letter-spacing: -0.5px;
            margin-bottom: 14px;
        }

        .side-content p {
            max-width: 430px;
            margin: 0 auto;
            font-size: 15px;
            line-height: 1.8;
            opacity: 0.92;
        }

        .alert {
            border-radius: 16px;
            font-size: 14px;
            padding: 12px 14px;
        }

        @media (max-width: 991.98px) {
            .login-form-area {
                min-height: auto;
                padding: 42px 30px 30px;
            }

            .login-card {
                border-radius: 26px;
            }
        }

        @media (max-width: 575.98px) {
            .login-page {
                padding: 18px 0;
            }

            .login-form-area {
                padding: 34px 22px 26px;
            }

            .brand-logo {
                width: 64px;
                height: 64px;
            }

            .brand-area h4 {
                font-size: 22px;
            }

            .developer-contact {
                flex-direction: column;
                gap: 0;
            }

            .developer-contact span {
                display: none;
            }
        }
    </style>
</head>

<body>

    <main class="login-page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-11 col-md-9 col-sm-11">

                    <div class="card login-card">
                        <div class="row g-0">

                            <div class="col-lg-5">
                                <div class="login-form-area">

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="brand-area">
                                            <img class="brand-logo"
                                                 src="{{ asset('assets/images/logo.svg') }}"
                                                 alt="Shahjalal Enterprise"
                                                 onerror="this.style.display='none'">

                                            <h4>Welcome Back</h4>
                                            <p>Sign in to continue to Shahjalal Enterprise</p>
                                        </div>

                                        @if ($errors->has('login'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('login') }}
                                            </div>
                                        @endif

                                        @if ($errors->has('password'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label for="login" class="form-label">Username or Email</label>

                                            <div class="input-wrap">
                                                <span class="input-icon">
                                                    <i class="zmdi zmdi-account-circle"></i>
                                                </span>

                                                <input type="text"
                                                       class="form-control"
                                                       name="login"
                                                       id="login"
                                                       placeholder="Enter username or email"
                                                       value="{{ old('login') }}"
                                                       required
                                                       autofocus>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="password" class="form-label">Password</label>

                                            <div class="input-wrap">
                                                <span class="input-icon">
                                                    <i class="zmdi zmdi-lock"></i>
                                                </span>

                                                <input type="password"
                                                       class="form-control"
                                                       name="password"
                                                       id="password"
                                                       placeholder="Enter password"
                                                       required>

                                                <button type="button"
                                                        class="password-toggle"
                                                        id="togglePassword"
                                                        aria-label="Show password">
                                                    <i class="zmdi zmdi-eye"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-login w-100">
                                            SIGN IN
                                        </button>
                                    </form>

                                    <div class="divider-line"></div>

                                    <div class="login-footer">
                                        <div>
                                            &copy; {{ date('Y') }}
                                            <a href="{{ route('index') }}">Shahjalal Enterprise</a>.
                                            All rights reserved.
                                        </div>

                                        <div class="developer-line">
                                            Developed by <strong>Towhid Hasan Zahor</strong>
                                        </div>

                                        <div class="developer-contact">
                                            <a href="mailto:towhid.hasan.zahor@gmail.com">
                                                towhid.hasan.zahor@gmail.com
                                            </a>
                                            <span>|</span>
                                            <a href="tel:01521256487">
                                                01521256487
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-7 d-none d-lg-block">
                                <div class="side-panel">
                                    <div class="side-content">
                                        <img src="{{ asset('assets/backend/images/signin.svg') }}"
                                             alt="Sign In">

                                        <h3>Manage Your Business Easily</h3>
                                        <p>
                                            Secure access to your dashboard, customers, transactions,
                                            reports and backups from one reliable place.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const passwordInput = document.getElementById('password');
            const togglePassword = document.getElementById('togglePassword');

            if (!passwordInput || !togglePassword) return;

            togglePassword.addEventListener('click', function () {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                const icon = togglePassword.querySelector('i');

                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                togglePassword.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');

                if (icon) {
                    icon.className = isPassword ? 'zmdi zmdi-eye-off' : 'zmdi zmdi-eye';
                }
            });
        });
    </script>

</body>
</html>