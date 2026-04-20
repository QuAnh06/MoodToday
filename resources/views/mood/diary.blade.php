@extends('layouts.app')

@section('title', 'My Mood Diary')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/mood/mood-style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mood/diary-style.css') }}">
@endpush

@section('content')
<div class="diary-container">
    <button type="button" class="btn-back" onclick="history.back();">
        <i class="bi bi-arrow-left"></i> Back
    </button>
    <div class="diary-hero">
        <div>
            <p class="diary-eyebrow">Mood Today</p>
            <h1>Hành trình cảm xúc của bạn</h1>
            <p class="diary-intro">Lưu lại từng tâm trạng, nhìn lại những ngày đã qua và khám phá xu hướng cảm xúc qua thời gian.</p>
        </div>
    </div>

    @php 
        $latestLog = $logs->flatten()->first();
        $totalDays = $logs->count();
        $flatLogs = $logs->flatten();
        $mostCommonMood = $flatLogs->groupBy('mood_id')
            ->map(fn($group) => $group->count())
            ->sort()
            ->reverse()
            ->keys()
            ->first();
        $mostCommonMoodLabel = $flatLogs->first(fn($log) => $log->mood_id == $mostCommonMood)?->moodType?->label ?? 'N/A';
    @endphp

    <div class="diary-summary-grid">
        <div class="summary-card card-blue">
            <div class="card-icon">📊</div>
            <span class="summary-title">Total Entries</span>
            <strong>{{ $totalLogs }}</strong>
        </div>
    
        <div class="summary-card card-yellow">
            <div class="card-icon">📅</div>
            <span class="summary-title">Days Logged</span>
            <strong>{{ $totalDays }}</strong>
        </div>
    
        <div class="summary-card card-purple">
            <div class="card-icon">😊</div>
            <span class="summary-title">Most Common</span>
            <strong>{{ $mostCommonMoodLabel }}</strong>
        </div>
    
        <div class="summary-card card-cyan">
            <div class="card-icon">📍</div>
            <span class="summary-title">Latest Entry</span>
            <strong>{{ $logs->keys()->first() ?? 'None' }}</strong>
        </div>
    </div>

    <div class="timeline">
        @forelse ($logs as $date => $dayLogs)
            <div class="timeline-group">
                <div class="timeline-group-header">
                    <span class="timeline-bullet"></span>
                    <h3 class="timeline-date">{{ $date }}</h3>
                </div>
                
                @foreach ($dayLogs as $log)
                    <a href="{{ route('mood.result', ['log_id' => $log->id]) }}" class="timeline-card">
                        <div class="timeline-time">{{ $log->created_at->format('H:i') }}</div>
                        <div class="timeline-content">
                            <span class="timeline-emoji">{{ $log->moodType?->emoji }}</span>
                            <div>
                                <h4>{{ $log->moodType?->label ?? 'Không rõ' }}</h4>
                                <p>{{ \Illuminate\Support\Str::limit($log->user_text ?? 'Không có ghi chú', 110) }}</p>
                            </div>
                        </div>
                        <span class="timeline-arrow"><i class="bi bi-chevron-right"></i></span>
                    </a>
                @endforeach
            </div>
        @empty
            <div class="empty-state">
                <p>Bạn chưa có kỉ niệm nào. Hãy bắt đầu chia sẻ tâm trạng hôm nay để lưu lại hành trình cảm xúc.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection