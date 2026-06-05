<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Restaurant Inventory')</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #111827;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #111827;
            color: white;
            padding: 22px 18px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 30px;
            line-height: 1.3;
        }

        .brand span {
            display: block;
            font-size: 13px;
            font-weight: normal;
            color: #9ca3af;
            margin-top: 4px;
        }

        .menu {
            padding-bottom: 160px;
        }

        .menu a {
            display: block;
            color: #d1d5db;
            text-decoration: none;
            padding: 11px 12px;
            border-radius: 7px;
            margin-bottom: 8px;
            transition: 0.2s;
        }

        .menu a:hover {
            background: #1f2937;
            color: white;
        }

        .menu a.active {
            background: #2563eb;
            color: white;
        }

        .main {
            margin-left: 250px;
            width: calc(100% - 250px);
            padding: 28px;
        }

        .page-header {
            background: white;
            padding: 18px 22px;
            border-radius: 10px;
            margin-bottom: 22px;
            border: 1px solid #e5e7eb;
        }

        .page-header h2 {
            margin: 0;
        }

        .content-card {
            background: white;
            padding: 24px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        .btn {
            display: inline-block;
            padding: 9px 14px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-green {
            background: #16a34a;
        }

        .btn-red {
            background: #dc2626;
        }

        .btn-gray {
            background: #475569;
        }

        .btn-purple {
            background: #7c3aed;
        }

        .alert-success {
            padding: 12px;
            background: #dcfce7;
            color: #166534;
            margin-bottom: 15px;
            border-radius: 6px;
        }

        .alert-error {
            padding: 12px;
            background: #fee2e2;
            color: #991b1b;
            margin-bottom: 15px;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        th, td {
            border: 1px solid #e5e7eb;
            padding: 11px;
            text-align: left;
        }

        th {
            background: #f1f5f9;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 15px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
        }

        label {
            font-weight: bold;
        }

        form.inline {
            display: inline;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
            padding: 4px 8px;
            border-radius: 5px;
        }

        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
            padding: 4px 8px;
            border-radius: 5px;
        }

        .top-actions {
            margin-bottom: 15px;
        }

        .back {
            display: inline-block;
            margin-left: 10px;
            color: #2563eb;
            text-decoration: none;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            padding: 22px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }

        .stat-card h3 {
            margin: 0;
            color: #475569;
            font-size: 15px;
        }

        .stat-card p {
            font-size: 30px;
            font-weight: bold;
            margin: 12px 0 0;
            color: #111827;
        }

        .sidebar-user {
            position: absolute;
            left: 18px;
            right: 18px;
            bottom: 20px;
        }

        .user-box {
            background: #1f2937;
            padding: 14px;
            border-radius: 10px;
        }

        .user-name {
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .user-email {
            font-size: 12px;
            color: #9ca3af;
            margin-bottom: 8px;
            word-break: break-all;
        }

        .user-role {
            display: inline-block;
            font-size: 12px;
            background: #374151;
            color: #d1d5db;
            padding: 4px 8px;
            border-radius: 5px;
            margin-bottom: 12px;
        }

        .logout-btn {
            width: 100%;
            padding: 9px 12px;
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .logout-btn:hover {
            background: #b91c1c;
        }

        .login-btn,
        .register-btn {
            display: block;
            text-align: center;
            padding: 9px 12px;
            border-radius: 6px;
            text-decoration: none;
            margin-bottom: 8px;
        }

        .login-btn {
            background: #2563eb;
            color: white;
        }

        .register-btn {
            background: #374151;
            color: white;
        }
    </style>

    @yield('style')
</head>
<body>

<div class="app">
    <aside class="sidebar">
        <div class="brand">
            Restaurant IMS
            <span>Inventory Management</span>
        </div>

        <nav class="menu">
            @auth
                @php
                    $role = auth()->user()->role ?? 'staff';
                @endphp

                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                @if(in_array($role, ['admin', 'manager']))
                    <a href="{{ route('ingredients.index') }}" class="{{ request()->routeIs('ingredients.*') ? 'active' : '' }}">
                        Ingredients
                    </a>

                    <a href="{{ route('menu-items.index') }}" class="{{ request()->routeIs('menu-items.*') ? 'active' : '' }}">
                        Menu Items
                    </a>

                    <a href="{{ route('menu-portions.index') }}" class="{{ request()->routeIs('menu-portions.*') ? 'active' : '' }}">
                        Portions
                    </a>

                    <a href="{{ route('portion-ingredients.index') }}" class="{{ request()->routeIs('portion-ingredients.*') ? 'active' : '' }}">
                        Recipes
                    </a>
                @endif

                <a href="{{ route('orders.index') }}" class="{{ request()->routeIs('orders.*') ? 'active' : '' }}">
                    Orders
                </a>

                @if(in_array($role, ['admin', 'manager']))
                    <a href="{{ route('stock-movements.index') }}" class="{{ request()->routeIs('stock-movements.*') ? 'active' : '' }}">
                        Stock Report
                    </a>
                @endif
            @endauth
        </nav>

        <div class="sidebar-user">
            @auth
                <div class="user-box">
                    <div class="user-name">
                        {{ auth()->user()->name }}
                    </div>
                    <div class="user-role">
                        {{ ucfirst(auth()->user()->role ?? 'staff') }}
                    </div>

                    <form method="POST" action="{{ route('custom.logout') }}">
                        @csrf

                        <button type="submit" class="logout-btn">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="login-btn">Login</a>

                @if(Route::has('register'))
                    <a href="{{ route('register') }}" class="register-btn">Register</a>
                @endif
            @endauth
        </div>
    </aside>

    <main class="main">
        <div class="page-header">
            <h2>@yield('page-title')</h2>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</div>

</body>
</html>