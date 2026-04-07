@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/mood-style.css') }}">
<div class="app-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">{{ auth()->user()?->name ?? 'Bạn' }}</h5>
        <span class="status-badge bg-blue-soft">AI Suggestion</span>
    </div>

    <div class="main-card mb-3 text-center border-0 shadow-sm">
        <p class="text-muted small text-uppercase mb-1">Kết quả check-in</p>
        <div class="d-flex align-items-center justify-content-center gap-2">
            <span style="font-size:2.2rem; line-height:1;">{{ $log->moodType?->emoji }}</span>
            <h2 class="fst-italic fw-bold mb-0" style="color: var(--primary-blue);">
                {{ $log->moodType?->label }}
            </h2>
        </div>
        <p class="text-muted small mt-2 mb-0">
            {{ $log->time_of_day === 'morning' ? 'Buổi sáng' : 'Buổi tối' }}
        </p>
    </div>

    <div class="glass-monex p-4 border-0 shadow-sm">
        <h6 class="fw-bold mb-3">Lời nhắn hôm nay</h6>
        <pre class="m-0" style="white-space: pre-wrap; font-family: inherit;">{{ $content }}</pre>
    </div>

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('mood.history') }}" class="btn btn-outline-primary w-100">Xem lịch sử</a>
        <a href="{{ route('mood.checkin-ai') }}" class="btn btn-primary w-100">Check-in lại</a>
    </div>
</div>
@endsection