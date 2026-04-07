<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoodToday - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/mood-style.css') }}">
</head>
<body>

<div class="app-main-content d-flex flex-column justify-content-center px-4">
    <div class="mb-4">
        <a href="{{ route('profile') }}" class="text-dark"><i class="bi bi-arrow-left fs-4"></i></a>
    </div>
    <div class="text-center mb-5 animate-reveal">
        <h3 class="fw-800 display-6">Chào mừng <br>trở lại! 👋</h3>
        <p class="text-muted">Đăng nhập bằng tên tài khoản (Zalo ID).</p>
    </div>

    <form action="{{ route('login.post') }}" method="POST" class="animate-reveal delay-1">
        @csrf
        <div class="mb-3">
            <input
                type="text"
                name="zalo_id"
                class="form-control-monex @error('zalo_id') is-invalid @enderror"
                placeholder="Tên đăng nhập (zalo_id)"
                required
            >
            @error('zalo_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn-monex-premium w-100 shadow-lg mb-3">ĐĂNG NHẬP</button>
    </form>

    <div class="text-center mt-4 animate-reveal delay-2">
        <p class="small text-muted">Hoặc đăng nhập bằng</p>
        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-outline-light shadow-sm rounded-pill px-4 py-2 text-dark"><i class="bi bi-google me-2 text-danger"></i>Google</button>
            <button class="btn btn-outline-light shadow-sm rounded-pill px-4 py-2 text-dark"><i class="bi bi-facebook me-2 text-primary"></i>Facebook</button>
        </div>
        <p class="small text-muted mt-5">Chưa có tài khoản? <a href="{{ route('register') }}" class="fw-bold text-primary text-decoration-none">Đăng ký ngay</a></p>
    </div>
</div>
</body>
</html>