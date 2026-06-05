<x-guest-layout>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background: #f3f4f6;
    }

    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: linear-gradient(135deg, #eef2ff, #f8fafc);
    }

    .login-card {
        width: 100%;
        max-width: 420px;
        background: #ffffff;
        padding: 35px;
        border-radius: 16px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .login-header {
        text-align: center;
        margin-bottom: 28px;
    }

    .login-header h1 {
        font-size: 28px;
        color: #111827;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .login-header p {
        font-size: 14px;
        color: #6b7280;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-group input {
        width: 100%;
        height: 46px;
        padding: 0 14px;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-size: 15px;
        color: #111827;
        outline: none;
        background: #ffffff;
        transition: 0.25s ease;
    }

    .form-group input:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.12);
    }

    .form-group input::placeholder {
        color: #9ca3af;
    }

    .options-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin: 6px 0 22px;
    }

    .remember {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #4b5563;
        cursor: pointer;
    }

    .remember input {
        width: 16px;
        height: 16px;
        accent-color: #4f46e5;
    }

    .forgot-link {
        font-size: 14px;
        color: #4f46e5;
        text-decoration: none;
        font-weight: 600;
    }

    .forgot-link:hover {
        text-decoration: underline;
    }

    .login-btn {
        width: 100%;
        height: 48px;
        background: #4f46e5;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.25s ease;
    }

    .login-btn:hover {
        background: #4338ca;
        transform: translateY(-1px);
        box-shadow: 0 10px 22px rgba(79, 70, 229, 0.25);
    }

    .register-text {
        text-align: center;
        margin-top: 22px;
        font-size: 14px;
        color: #6b7280;
    }

    .register-text a {
        color: #4f46e5;
        font-weight: 700;
        text-decoration: none;
    }

    .register-text a:hover {
        text-decoration: underline;
    }

    .footer-text {
        text-align: center;
        margin-top: 24px;
        font-size: 13px;
        color: #9ca3af;
    }

    @media (max-width: 480px) {
        .login-card {
            padding: 28px 22px;
        }

        .login-header h1 {
            font-size: 25px;
        }

        .options-row {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="login-wrapper">

    <div class="login-card">

        <div class="login-header">
            <h1>Login</h1>
            <p>Access your restaurant inventory dashboard</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email Address</label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                    autofocus
                >
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                    autocomplete="current-password"
                >
            </div>

            <!-- Remember and Forgot -->
            <div class="options-row">

                <label for="remember_me" class="remember">
                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                    >

                    <span>Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Forgot password?
                    </a>
                @endif

            </div>

            <!-- Login Button -->
            <button type="submit" class="login-btn">
                Login
            </button>

            <!-- Register Link -->
            @if (Route::has('register'))
                <div class="register-text">
                    Don’t have an account?
                    <a href="{{ route('register') }}">Register</a>
                </div>
            @endif

        </form>

        <div class="footer-text">
            © {{ date('Y') }} Restaurant Inventory System
        </div>

    </div>

</div>

</x-guest-layout>