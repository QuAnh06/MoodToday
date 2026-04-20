<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoodToday - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/mood/mood-style.css') }}">

    @stack('styles')
</head>
<body>

    <div class="app-main-content">
        
        <header class="top-header">
            <div class="header-brand">MoodToday</div>
            <div class="dropdown">
                <div class="profile-circle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-fill"></i>
                </div>
                
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3" style="border-radius: 20px; min-width: 220px; padding: 12px; z-index: 2000;">
                    <div class="px-3 py-2 mb-2">
                        <p class="small text-muted mb-0">Tài khoản của</p>
                        <h6 class="fw-bold mb-0">
                            @auth
                                {{ auth()->user()->name }}
                            @else
                                Khách
                            @endauth
                        </h6>
                    </div>
                    <li><hr class="dropdown-divider opacity-50"></li>
                    @auth
                        <li><a class="dropdown-item rounded-3 py-2" href="{{ route('profile') }}"><i class="bi bi-person me-2"></i>Hồ sơ cá nhân</a></li>
                        <li><a class="dropdown-item rounded-3 py-2" href="{{ route('logout') }}"><i class="bi bi-box-arrow-right me-2 text-danger"></i>Đăng xuất</a></li>
                    @else
                        <li><a class="dropdown-item rounded-3 py-2" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-2 text-primary"></i>Đăng nhập</a></li>
                        <li><a class="dropdown-item rounded-3 py-2" href="{{ route('register') }}"><i class="bi bi-person-plus me-2 text-success"></i>Đăng ký mới</a></li>
                    @endauth
                </ul>
            </div>
        </header>

        <div class="content-wrapper px-3">
            @yield('content')
        </div>

        <div class="bottom-nav">
            <a href="{{ route('home') }}" 
                class="nav-item {{ request()->routeIs('home') && request('tab', 'home') === 'home' ? 'active' : '' }}">
                <i class="bi bi-house-door-fill"></i>
                <span>Home</span>
            </a>
            
            <a href="{{ route('home', ['tab' => 'menu']) }}" 
                class="nav-item {{ (request()->routeIs('home') && request('tab') === 'menu') || request()->routeIs('love.*', 'crush-message*', 'diary*') ? 'active' : '' }}">
                
                <i class="bi bi-grid-3x3-gap-fill"></i>
                <span>Menu</span>
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>