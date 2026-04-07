<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoodToday - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/mood-style.css') }}">
</head>
<body>
<div class="app-main-content d-flex flex-column px-4 py-5">
    <div class="mb-4">
        <a href="{{ route('login') }}" class="text-dark"><i class="bi bi-arrow-left fs-4"></i></a>
    </div>

    <div class="text-start mb-5 animate-reveal">
        <h3 class="fw-800 display-6">Tạo tài khoản 🚀</h3>
        <p class="text-muted">Bắt đầu hành trình thấu hiểu bản thân cùng MoodToday.</p>
    </div>

    <form action="{{ route('register.post') }}" method="POST" class="animate-reveal delay-1">
        @csrf
        <div class="mb-3">
            <label class="small fw-bold mb-2 px-1">Tên đăng nhập (Zalo ID)</label>
            <input type="text" name="zalo_id" class="form-control-monex @error('zalo_id') is-invalid @enderror" placeholder="Ví dụ: 123456789" required>
            
            @error('zalo_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label class="small fw-bold mb-2 px-1">Tên hiển thị</label>
            <input type="text" name="name" class="form-control-monex @error('name') is-invalid @enderror" placeholder="Ví dụ: Lê Quang Anh" required>

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-monex-premium w-100 shadow-lg mb-4">ĐĂNG KÝ NGAY</button>
    </form>

    <div class="text-center animate-reveal delay-2">
        <p class="small text-muted mb-4">Hoặc tiếp tục với</p>
        <div class="d-flex justify-content-center gap-3 mb-5">
            <button class="btn btn-outline-light shadow-sm rounded-pill px-4 py-2 text-dark"><i class="bi bi-google me-2 text-danger"></i>Google</button>
            <button class="btn btn-outline-light shadow-sm rounded-pill px-4 py-2 text-dark"><i class="bi bi-facebook me-2 text-primary"></i>Facebook</button>
        </div>
        <p class="small text-muted">Đã có tài khoản? <a href="{{ route('login') }}" class="fw-bold text-primary text-decoration-none">Đăng nhập</a></p>
    </div>
</div>
</body>
</html>