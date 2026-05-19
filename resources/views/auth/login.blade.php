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
            --primary-dark: #6d28d9;
            --secondary: #ec4899;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
            --border: #dde3ee;
            --bg-soft: #f8f7ff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background:
                radial-gradient(circle at top left, rgba(124, 58, 237, 0.14), transparent 34%),
                radial-gradient(circle at bottom right, rgba(236, 72, 153, 0.14), transparent 32%),
                linear-gradient(135deg, #f8f7ff 0%, #eff6ff 45%, #fff7ed 100%);
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 32px 0;
        }

        .login-card {
            border: 0;
            border-radius: 28px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.15);
        }

        .login-form-area {
            padding: 46px 42px;
        }

        .brand-area {
            text-align: center;
            margin-bottom: 30px;
        }

        .brand-logo {
            width: 78px;
            height: 78px;
            object-fit: contain;
            margin-bottom: 16px;
        }

        .brand-area h4 {
            color: var(--text-dark);
            font-weight: 800;
            margin-bottom: 7px;
        }

        .brand-area p {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 0;
        }

        .form-label {
            color: #374151;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap .form-control {
            height: 52px;
            border-radius: 14px;
            border: 1px solid var(--border);
            background: #fbfcff;
            padding-left: 48px;
            padding-right: 48px;
            font-size: 14px;
            color: var(--text-dark);
            transition: all 0.2s ease;
        }

        .input-wrap .form-control:focus {
            border-color: var(--primary);
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.13);
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
            height: 52px;
            border: 0;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: #ffffff;
            font-weight: 800;
            letter-spacing: 0.4px;
            box-shadow: 0 14px 28px rgba(124, 58, 237, 0.26);
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 18px 35px rgba(124, 58, 237, 0.34);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .side-panel {
            min-height: 560px;
            height: 100%;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px;
            background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
        }

        .side-panel::before {
            content: "";
            position: absolute;
            width: 270px;
            height: 270px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.14);
            top: -90px;
            right: -75px;
        }

        .side-panel::after {
            content: "";
            position: absolute;
            width: 230px;
            height: 230px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.12);
            bottom: -80px;
            left: -75px;
        }

        .side-content {
            position: relative;
            z-index: 2;
            color: #ffffff;
            text-align: center;
        }

        .side-content img {
            width: 100%;
            max-width: 430px;
            margin-bottom: 28px;
        }

        .side-content h3 {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .side-content p {
            max-width: 440px;
            margin: 0 auto;
            font-size: 15px;
            line-height: 1.75;
            opacity: 0.94;
        }

        .copyright {
            margin-top: 24px;
            font-size: 13px;
            color: var(--text-muted);
            text-align: center;
        }

        .copyright a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
        }

        .copyright a:hover {
            text-decoration: underline;
        }

        .alert {
            border-radius: 14px;
            font-size: 14px;
            padding: 12px 14px;
        }

        @media (max-width: 991.98px) {
            .login-form-area {
                padding: 38px 28px;
            }

            .login-card {
                border-radius: 24px;
            }
        }

        @media (max-width: 575.98px) {
            .login-page {
                padding: 18px 0;
            }

            .login-form-area {
                padding: 32px 22px;
            }

            .brand-logo {
                width: 66px;
                height: 66px;
            }

            .brand-area h4 {
                font-size: 21px;
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

                                        {{-- Remember me enable korte chaile eta uncomment korben --}}
                                        {{--
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                            <label class="form-check-label" for="remember_me">
                                                Remember Me
                                            </label>
                                        </div>
                                        --}}

                                        <button type="submit" class="btn btn-login w-100">
                                            SIGN IN
                                        </button>
                                    </form>

                                    <div class="copyright">
                                        &copy; {{ date('Y') }},
                                        <span><a href="#">Shahjalal Enterprise</a></span>
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
                                            Secure access to your dashboard, inventory, staff,
                                            stock and business reports from one place.
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