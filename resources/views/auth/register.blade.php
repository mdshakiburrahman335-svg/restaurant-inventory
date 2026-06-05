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

    .register-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: linear-gradient(135deg, #eef2ff, #f8fafc);
    }

    .register-card {
        width: 100%;
        max-width: 430px;
        background: #ffffff;
        padding: 35px;
        border-radius: 16px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }

    .register-header {
        text-align: center;
        margin-bottom: 28px;
    }

    .register-header h1 {
        font-size: 28px;
        color: #111827;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .register-header p {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.5;
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

    .register-btn {
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
        margin-top: 6px;
    }

    .register-btn:hover {
        background: #4338ca;
        transform: translateY(-1px);
        box-shadow: 0 10px 22px rgba(79, 70, 229, 0.25);
    }

    .login-text {
        text-align: center;
        margin-top: 22px;
        font-size: 14px;
        color: #6b7280;
    }

    .login-text a {
        color: #4f46e5;
        font-weight: 700;
        text-decoration: none;
    }

    .login-text a:hover {
        text-decoration: underline;
    }

    .footer-text {
        text-align: center;
        margin-top: 24px;
        font-size: 13px;
        color: #9ca3af;
    }

    @media (max-width: 480px) {
        .register-card {
            padding: 28px 22px;
        }

        .register-header h1 {
            font-size: 25px;
        }
    }
</style>

<div class="register-wrapper">

    <div class="register-card">

        <div class="register-header">
            <h1>Create Account</h1>
            <p>Register to manage your restaurant inventory dashboard</p>
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">Full Name</label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter your full name"
                    required
                    autofocus
                >
            </div>

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
                    autocomplete="new-password"
                >
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm your password"
                    required
                >
            </div>

            <!-- Register Button -->
            <button type="submit" class="register-btn">
                Register
            </button>

            <!-- Login Link -->
            <div class="login-text">
                Already have an account?
                <a href="{{ route('login') }}">Login</a>
            </div>

        </form>

        <div class="footer-text">
            © {{ date('Y') }} Restaurant Inventory System
        </div>

    </div>

</div>

</x-guest-layout>