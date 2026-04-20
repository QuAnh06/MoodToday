@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/mood/mood-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mood/result-style.css') }}">
@endpush

@section('content')

<div class="app-container">
    <button type="button" class="btn-back" onclick="history.back();">
        <i class="bi bi-arrow-left"></i> Back
    </button>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Chào, {{ auth()->user()?->name ?? "bạn" }}</h5>
        <span class="status-badge bg-blue-soft">AI Suggestion</span>
    </div>

    <div class="ai-quote-card mb-3 animate-reveal">
        <p class="mb-0">"{{ $data->quote }}"</p>
    </div>

    <div class="glass-monex p-4 border-0 shadow-sm mb-3 animate-reveal delay-1">
        <h6 class="fw-bold mb-3"><i class="bi bi-stars text-warning"></i> Gợi ý hoạt động</h6>
        <ul class="list-unstyled mb-0">
            @foreach($data->activities as $activity)
                <li class="mb-2 d-flex align-items-start">
                    <span class="me-2">•</span>
                    <span>{{ $activity }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="glass-monex p-4 border-0 shadow-sm animate-reveal delay-2">
        <h6 class="fw-bold mb-3">Chia sẻ nhẹ</h6>
        <p class="m-0 text-secondary" style="line-height: 1.6;">
            {{ $data->sharing }}
        </p>
    </div>

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('diary') }}" class="btn btn-outline-primary w-100">Lịch sử</a>
        <a href="{{ route('home') }}" class="btn btn-primary w-100">Check-in tiếp</a>
    </div>
</div>

@endsection