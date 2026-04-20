@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/mood/mood-style.css') }}">
@endpush

@section('content')
<div class="app-container d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="ai-loader mb-4">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div>
    </div>
    
    <h4 class="fw-bold text-center">MoodToday AI đang lắng nghe...</h4>
    <p class="text-muted text-center">Mình đang chuẩn bị lời khuyên tốt nhất dành cho bạn.</p>

    <script>
        window.location.href = "{{ route('mood.result', ['log_id' => $log_id]) }}";
    </script>
</div>

<style>
    .ai-loader {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.1); opacity: 0.7; }
        100% { transform: scale(1); opacity: 1; }
    }
</style>
@endsection