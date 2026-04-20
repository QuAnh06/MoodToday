@extends('layouts.app')

@section('title', 'AI Giải mã tin nhắn crush')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/crush-message/crush-message.css') }}">
@endpush

@section('content')
<div class="app-container pt-4 pb-5">
    <button type="button" class="btn-back" onclick="history.back();">
        <i class="bi bi-arrow-left"></i> Back
    </button>

    <div class="page-header animate-reveal">
        <p class="small text-muted mb-2">AI Giải mã tin nhắn crush</p>
        <h1 class="fw-800 mb-2">Crush đang muốn nói gì?</h1>
        <p class="text-muted">Dán chat vào ô bên dưới và AI sẽ giải mã cảm xúc ẩn.</p>
    </div>

    <div class="info-card animate-reveal delay-1">
        <div class="info-card-icon"><i class="bi bi-envelope-heart-fill"></i></div>
        <div>
            <h5 class="fw-bold mb-3">Cách dùng nhanh</h5>
            <ul class="text-muted mb-0">
                <li>Sao chép đoạn chat từ Zalo hoặc Messenger.</li>
                <li>Nhấn giữ trong ô và chọn Dán.</li>
                <li>Nhấn nút AI phân tích để nhận gợi ý.</li>
            </ul>
        </div>
    </div>

    <div class="action-card animate-reveal delay-2">
        <div class="action-row">
            <button class="btn-action">Dán tin nhắn</button>
            <button class="btn-action btn-outline">Sao chép</button>
        </div>
        <textarea class="form-control-monex message-area" rows="6" placeholder="Dán tin nhắn crush vào đây..." ></textarea>
    </div>

    <button class="btn-monex-premium w-100 mt-4">AI phân tích</button>
</div>

@endsection