<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>MoodToday - Chào mừng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/mood-style.css') }}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700;800&display=swap" rel="stylesheet">
</head>
<body>

    <div class="splash-wrapper">
        <div class="animate-reveal">
            <img src="{{ asset('images/logo-moodtoday.png') }}" alt="Logo" class="splash-logo">
        </div>

        <div class="animate-reveal delay-1">
            <img src="{{ asset('images/splash.png') }}" 
                 class="splash-img" alt="Illustration">
        </div>

        <div class="content-text px-3">
            <h1 class="fw-800 display-6 mb-3 animate-reveal delay-2">
                Lắng nghe <br><span style="color: #2D5BFF">cảm xúc</span> của bạn
            </h1>
            <p class="text-muted animate-reveal delay-3">
                Khám phá bản thân mỗi ngày cùng AI. <br>
                Chào mừng **Lê Quang Anh** quay trở lại!
            </p>
        </div>

        <div class="w-100 px-4 animate-reveal" style="animation-delay: 1.2s;">
            <a href="{{ route('home') }}" class="btn-start d-block mx-auto">
                BẮT ĐẦU NGAY
            </a>
        </div>
    </div>

</body>
</html>