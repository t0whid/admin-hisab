<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Shahjalal Enterprise Login">

    <title>Log In | Shahjalal Enterprise</title>

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/backend/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/style.min.css') }}">

    <style>
        body.theme-blush {
            min-height: 100vh;
            background: linear-gradient(135deg, #f7f3ff 0%, #eef7ff 45%, #fff7f2 100%);
            font-family: Arial, sans-serif;
        }

        .authentication {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 30px 0;
        }

        .login-wrapper {
            width: 100%;
        }

        .login-card {
            border: none;
            border-radius: 22px;
            overflow: hidden;
            box-shadow: 0 20px 55px rgba(30, 41, 59, 0.14);
            background: #ffffff;
        }

        .login-left {
            padding: 42px 38px;
        }

        .brand-box {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand-box .logo {
            width: 76px;
            height: 76px;
            object-fit: contain;
            margin-bottom: 14px;
        }

        .brand-box h4 {
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 6px;
        }

        .brand-box p {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 0;
        }

        .custom-input-group {
            position: relative;
            margin-bottom: 18px;
        }

        .custom-input-group .form-control {
            height: 50px;
            border-radius: 12px;
            border: 1px solid #d9dee8;
            padding-left: 46px;
            padding-right: 46px;
            font-size: 14px;
            background: #fbfcff;
            transition: all 0.2s ease;
        }

        .custom-input-group .form-control:focus {
            border-color: #8b5cf6;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.13);
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #8b95a5;
            z-index: 3;
            font-size: 18px;
        }

        .password-toggle {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #8b95a5;
            z-index: 4;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            user-select: none;
        }

        .login-btn {
            height: 50px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #7c3aed, #ec4899);
            font-weight: 700;
            letter-spacing: 0.5px;
            box-shadow: 0 12px 24px rgba(124, 58, 237, 0.25);
            transition: all 0.2s ease;
        }

        .login-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 16px 30px rgba(124, 58, 237, 0.32);
        }

        .login-btn:focus {
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.22);
        }

        .side-panel {
            height: 100%;
            min-height: 520px;
            background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 45px;
            position: relative;
            overflow: hidden;
        }

        .side-panel:before {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.13);
            top: -80px;
            right: -70px;
        }

        .side-panel:after {
            content: "";
            position: absolute;
            width: 210px;
            height: 210px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.11);
            bottom: -70px;
            left: -60px;
        }

        .side-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: #ffffff;
        }

        .side-content img {
            max-width: 92%;
            margin-bottom: 25px;
        }

        .side-content h3 {
            font-weight: 700;
            margin-bottom: 12px;
        }

        .side-content p {
            font-size: 15px;
            line-height: 1.7;
            opacity: 0.92;
            margin-bottom: 0;
        }

        .copyright {
            margin-top: 22px;
            font-size: 13px;
            color: #6b7280;
        }

        .copyright a {
            color: #7c3aed;
            font-weight: 600;
        }

        .alert {
            border-radius: 12px;
            font-size: 14px;
            padding: 12px 14px;
        }

        @media (max-width: 991px) {
            .side-panel {
                display: none;
            }

            .login-left {
                padding: 34px 24px;
            }

            .authentication {
                padding: 18px 0;
            }
        }

        @media (max-width: 575px) {
            .login-card {
                border-radius: 18px;
            }

            .brand-box .logo {
                width: 64px;
                height: 64px;
            }

            .brand-box h4 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body class="theme-blush">

    <div class="authentication">
        <div class="container login-wrapper">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-11 col-md-8 col-sm-11">

                    <div class="card login-card">
                        <div class="row no-gutters">

                            <div class="col-lg-5 col-md-12">
                                <div class="login-left">

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="brand-box">
                                            <img class="logo" src="{{ asset('assets/images/logo.svg') }}"
                                                alt="Logo" onerror="this.style.display='none'">

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

                                        <div class="custom-input-group">
                                            <span class="input-icon">
                                                <i class="zmdi zmdi-account-circle"></i>
                                            </span>
                                            <input type="text" class="form-control" name="login"
                                                placeholder="Username or Email" value="{{ old('login') }}" required
                                                autofocus>
                                        </div>

                                        <div class="custom-input-group">
                                            <span class="input-icon">
                                                <i class="zmdi zmdi-lock"></i>
                                            </span>

                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="Password" required>

                                            <span class="password-toggle" id="togglePassword">
                                                <i class="zmdi zmdi-eye"></i>
                                            </span>
                                        </div>

                                        {{-- Remember me enable korte chaile uncomment korben --}}
                                        {{--
                                        <div class="checkbox mb-3">
                                            <input id="remember_me" type="checkbox" name="remember">
                                            <label for="remember_me">Remember Me</label>
                                        </div>
                                        --}}

                                        <button type="submit" class="btn btn-primary btn-block login-btn">
                                            SIGN IN
                                        </button>
                                    </form>

                                    <div class="copyright text-center">
                                        &copy; {{ date('Y') }},
                                        <span><a href="#">Shahjalal Enterprise</a></span>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-7 d-none d-lg-block">
                                <div class="side-panel">
                                    <div class="side-content">
                                        <img src="{{ asset('assets/backend/images/signin.svg') }}" alt="Sign In">

                                        <h3>Manage Your Business Easily</h3>
                                        <p>
                                            Secure access to your dashboard, inventory, staff,
                                            stock and business reports.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/backend/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/backend/bundles/vendorscripts.bundle.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var passwordInput = document.getElementById('password');
            var togglePassword = document.getElementById('togglePassword');

            if (passwordInput && togglePassword) {
                togglePassword.addEventListener('click', function() {
                    var isPassword = passwordInput.getAttribute('type') === 'password';

                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    togglePassword.innerText = isPassword ? 'HIDE' : 'SHOW';
                });
            }
        });
    </script>

</body>

</html>
