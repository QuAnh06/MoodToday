<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoodToday Admin - @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/mood-style.css') }}">
</head>
<body class="admin-body">
    <div class="admin-container">
        <nav class="admin-nav">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="admin-nav-brand">
                        <i class="bi bi-emoji-smile-fill"></i>
                        <span>MoodToday Admin</span>
                    </div>
                    <div class="admin-nav-menu">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="bi bi-house-door"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="bi bi-people"></i> Users
                        </a>
                        <a href="{{ route('admin.moods.index') }}" class="nav-link {{ request()->routeIs('admin.moods.*') ? 'active' : '' }}">
                            <i class="bi bi-emoji-expressionless"></i> Moods
                        </a>
                        <a href="{{ route('admin.prompts.index') }}" class="nav-link {{ request()->routeIs('admin.prompts.*') ? 'active' : '' }}">
                            <i class="bi bi-robot"></i> AI Prompts
                        </a>
                        <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link logout-link">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <main class="admin-main">
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>