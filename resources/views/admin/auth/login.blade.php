<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Courier Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.0.9/css/boxicons.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #fff;
            color: #1a1a1a;
        }

        .login-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* Left Side - Branding */
        .login-left {
            background: linear-gradient(135deg, #e8634b 0%, #e8634b 100%);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 500px;
            height: 500px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .login-left::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -30%;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(30px);
            }
        }

        .login-left-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .login-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            backdrop-filter: blur(10px);
        }

        .logo-text {
            font-size: 28px;
            font-weight: 700;
            margin-top: 20px;
            letter-spacing: -0.5px;
        }

        .login-subtitle {
            font-size: 14px;
            opacity: 0.9;
            margin-top: 10px;
            line-height: 1.6;
        }

        .courier-illustration {
            width: 100%;
            max-width: 350px;
            margin-top: 60px;
            display: flex;
            justify-content: center;
        }

        .illustration-placeholder {
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 120px;
            backdrop-filter: blur(10px);
        }

        /* Right Side - Login Form */
        .login-right {
            background: #f8f9fa;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 60px 40px;
        }

        .login-form-wrapper {
            width: 100%;
            max-width: 400px;
        }

        .form-header {
            margin-bottom: 40px;
        }

        .form-title {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 10px;
        }

        .form-subtitle {
            font-size: 14px;
            color: #666;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
            background: white;
            color: #1a1a1a;
        }

        .form-input:focus {
            outline: none;
            border-color: #e8634b;
            box-shadow: 0 0 0 3px rgba(0, 102, 204, 0.1);
        }

        .form-input::placeholder {
            color: #999;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .form-remember {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .form-remember input {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: #e8634b;
        }

        .form-remember label {
            cursor: pointer;
            color: #666;
        }

        .form-forgot {
            color: #e8634b;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }

        .form-forgot:hover {
            color: #e8634b;
        }

        .btn-login {
            width: 100%;
            padding: 12px 24px;
            background: linear-gradient(135deg, #e8634b 0%, #e8634b 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 102, 204, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .error-message {
            background: #fee;
            border: 1px solid #fcc;
            color: #c33;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
            display: none;
        }

        .error-message.show {
            display: block;
        }

        .input-error {
            border-color: #dc3545 !important;
        }

        .input-error:focus {
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1) !important;
        }

        .error-text {
            color: #dc3545;
            font-size: 12px;
            margin-top: 4px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-container {
                grid-template-columns: 1fr;
            }

            .login-left {
                min-height: 250px;
                padding: 40px 20px;
            }

            .courier-illustration {
                max-width: 250px;
                margin-top: 30px;
            }

            .illustration-placeholder {
                width: 200px;
                height: 200px;
                font-size: 80px;
            }

            .login-right {
                padding: 40px 20px;
            }

            .login-form-wrapper {
                max-width: 100%;
            }

            .form-title {
                font-size: 24px;
            }

            .login-logo {
                margin-bottom: 20px;
            }

            .logo-icon {
                width: 60px;
                height: 60px;
                font-size: 32px;
            }

            .logo-text {
                font-size: 24px;
                margin-top: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Left Side -->
        <div class="login-left">
            <div class="login-left-content">
                <div class="login-logo">
                    <div class="logo-icon">
                        <i class='bx bx-package'></i>
                    </div>
                </div>
                <div class="logo-text">CourierHub</div>
                <p class="login-subtitle">Professional Courier Management System</p>

                <div class="courier-illustration">
                    <div class="illustration-placeholder">
                        <i class='bx bx-truck'></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side -->
        <div class="login-right">
            <div class="login-form-wrapper">
                <div class="form-header">
                    <h2 class="form-title">Welcome Back</h2>
                    <p class="form-subtitle">Sign in to your account to manage your courier operations</p>
                </div>

                <div class="error-message" id="errorMessage"></div>

                <form action="{{ route('auth.authenticate') }}" method="POST" id="login-form">
                    @csrf

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-input @error('email') input-error @enderror" id="email"
                            name="email" value="{{ old('email') }}" placeholder="name@company.com" required>
                        @error('email')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div style="position: relative;">
                            <input type="password" class="form-input @error('password') input-error @enderror"
                                id="password" name="password" placeholder="Enter your password" required>
                            <button type="button"
                                style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #666; font-size: 18px;"
                                onclick="togglePasswordVisibility()">
                                <i class='bx bx-hide' id="passwordToggleIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember & Forgot Password -->
                    <div class="form-actions">
                        <div class="form-remember">
                            <input type="checkbox" id="remember" name="remember" value="1">
                            <label for="remember">Remember me</label>
                        </div>
                        <a href="{{ route('forgot-password') }}" class="form-forgot">Forgot Password?</a>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn-login">
                        <i class='bx bx-lock-open-alt' style="margin-right: 8px;"></i>Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('passwordToggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bx-hide');
                toggleIcon.classList.add('bx-show');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bx-show');
                toggleIcon.classList.add('bx-hide');
            }
        }

        // Show error message if validation fails
        @if ($errors->any())
            document.getElementById('errorMessage').classList.add('show');
            document.getElementById('errorMessage').textContent = '{{ $errors->first() }}';
        @endif
    </script>
</body>

</html>
