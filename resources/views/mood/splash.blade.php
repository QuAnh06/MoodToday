<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>MoodToday - Chào mừng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/mood/mood-style.css') }}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;700;800&display=swap" rel="stylesheet">
</head>
<body>

    <div class="splash-wrapper">
        <div class="splash-top">
            <div class="splash-logo">MoodToday</div>
        </div>

        <div class="splash-card animate-reveal">
            <div class="splash-hero-grid">
                <div class="mood-blob mood-blob--green">
                    <div class="mood-emoji">😌</div>
                    <div class="mood-label">Calm</div>
                </div>
                <div class="mood-blob mood-blob--teal">
                    <div class="mood-emoji">😟</div>
                    <div class="mood-label">Fear</div>
                </div>
                <div class="mood-blob mood-blob--yellow">
                    <div class="mood-emoji">😡</div>
                    <div class="mood-label">Anger</div>
                </div>
                <div class="mood-blob mood-blob--pink">
                    <div class="mood-emoji">😊</div>
                    <div class="mood-label">Happy</div>
                </div>
            </div>

            <div class="splash-copy">
                <p class="splash-subtitle">Moodiary</p>
                <h1>We’re here to track your mood journey</h1>
                <p class="splash-description">Ghi lại cảm xúc mỗi ngày và nhìn lại hành trình tâm trạng theo phong cách MoodToday.</p>
                <a href="{{ route('home') }}" class="btn-start splash-button">Get Started</a>
            </div>
        </div>
    </div>

</body>
</html>