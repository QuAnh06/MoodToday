@extends('layouts.app')

@section('title', 'Kết quả giải mã tin nhắn')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/crush-message/crush-message.css') }}">
@endpush

@section('content')
<div class="app-container pt-4 pb-5">
    <button type="button" class="btn-back" onclick="history.back();">
        <i class="bi bi-arrow-left"></i> Back
    </button>

    <div class="page-header animate-reveal">
        <p class="small text-muted mb-2">Phân tích hoàn tất ✨</p>
        <h1 class="fw-800 mb-2">Lời giải mã từ AI</h1>
    </div>

    <div class="original-message-card animate-reveal delay-1">
        <div class="card-label">Tin nhắn gốc</div>
        <p class="mb-0 italic-text">"{{ $log->message_content }}"</p>
    </div>

    <div class="result-main-card animate-reveal delay-2">
        <div class="vibe-container text-center mb-4">
            <span class="vibe-badge">
                <i class="bi bi-reception-4"></i> Vibe: {{ $log->vibe }}
            </span>
        </div>

        <div class="result-section mb-4">
            <div class="section-title">
                <i class="bi bi-incognito text-purple"></i> Ý nghĩa thật sự
            </div>
            <div class="section-content">
                {{ $log->hidden_meaning }}
            </div>
        </div>

        <hr class="divider">

        <div class="result-section">
            <div class="section-title">
                <i class="bi bi-chat-heart-fill text-success"></i> Tuyệt chiêu "rep" lại
            </div>
            <div class="section-content highlight-text">
                {{ $log->reply_hint }}
            </div>
        </div>
    </div>

    <div class="action-footer animate-reveal delay-3 mt-4">
        <a href="{{ route('crush.index') }}" class="btn-monex-premium w-100 mb-3 text-decoration-none d-flex align-items-center justify-content-center">
            <i class="bi bi-arrow-repeat me-2"></i> Giải mã tin khác
        </a>
        <button class="btn-action btn-outline w-100" onclick="window.print()">
            <i class="bi bi-share me-2"></i> Lưu kết quả này
        </button>
    </div>
</div>
@endsection