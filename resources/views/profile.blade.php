@extends('layouts.app')

@section('content')

<div class="app-container pt-4">

    <div class="mb-4">
        <a href="{{ route('home') }}" class="text-dark"><i class="bi bi-arrow-left fs-4"></i></a>
    </div>
    <div class="text-center mb-5 animate-smooth">
        <div class="avatar-box mb-3 mx-auto shadow-sm" style="width: 110px; height: 110px; border-radius: 35px; background: white; display: flex; align-items: center; justify-content: center; border: 3px solid var(--soft-blue);">
            <i class="bi bi-person-fill text-primary" style="font-size: 3rem;"></i>
        </div>
        <h3 class="fw-800 mb-1">Lê Quang Anh</h3>
        <p class="text-muted small">qanh191001@gmail.com</p>
    </div>

    <div class="row g-3 mb-4 animate-smooth" style="animation-delay: 0.2s;">
        <div class="col-6">
            <div class="glass-monex text-center border-0 shadow-sm py-4">
                <p class="text-gray small mb-1">Mood Streak</p>
                <h2 class="fw-bold text-primary mb-0">5 Ngày</h2>
            </div>
        </div>
        <div class="col-6">
            <div class="glass-monex text-center border-0 shadow-sm py-4">
                <p class="text-gray small mb-1">Cảm xúc chính</p>
                <h2 class="fw-bold text-success mb-0">Vui</h2>
            </div>
        </div>
    </div>

    <div class="glass-monex animate-smooth" style="animation-delay: 0.4s;">
        <h6 class="fw-bold mb-4">Nhật ký tuần qua</h6>
        <div class="d-flex justify-content-between text-center px-1">
            <div class="small fw-bold">T2<br><span class="fs-4">😄</span></div>
            <div class="small fw-bold">T3<br><span class="fs-4 text-muted opacity-25">⚪</span></div>
            <div class="small fw-bold">T4<br><span class="fs-4">😴</span></div>
            <div class="small fw-bold">T5<br><span class="fs-4">😐</span></div>
            <div class="small fw-bold text-primary">T6<br><span class="fs-4">😄</span></div>
        </div>
    </div>
</div>
@endsection