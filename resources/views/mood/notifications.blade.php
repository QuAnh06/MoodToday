@extends('layouts.app')

@section('content')
<div class="app-main-content">
    <div class="pt-4 px-2">
        <h4 class="fw-800 mb-4 animate-reveal">Thông báo</h4>

        <div class="notification-wrapper">
            <div class="notification-card animate-reveal">
                <div class="noti-icon noti-ai"><i class="bi bi-robot"></i></div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-800 small">Gợi ý từ AI</h6>
                        <span class="noti-time">10m</span>
                    </div>
                    <p class="mb-0 text-muted small mt-1">Lê Quang Anh, hãy dành 5 phút để thiền định nhé.</p>
                </div>
            </div>
            <div class="notification-card animate-reveal delay-1">
                <div class="noti-icon noti-streak"><i class="bi bi-fire"></i></div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 fw-800 small">Mood Streak!</h6>
                        <span class="noti-time">2h</span>
                    </div>
                    <p class="mb-0 text-muted small mt-1">Chúc mừng bạn đã đạt chuỗi 5 ngày.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection