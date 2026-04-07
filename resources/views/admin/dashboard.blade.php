@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="admin-header">
    <h1 class="page-title">
        <i class="bi bi-house-door"></i>
        Dashboard
    </h1>
    <p class="page-subtitle">Tổng quan hệ thống MoodToday</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="bi bi-people-fill"></i>
        </div>
        <div class="stat-content">
            <h3>{{ $totalUsers }}</h3>
            <p>Tổng Users</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="bi bi-emoji-smile-fill"></i>
        </div>
        <div class="stat-content">
            <h3>{{ $totalMoods }}</h3>
            <p>Tổng Mood Logs</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="bi bi-calendar-check-fill"></i>
        </div>
        <div class="stat-content">
            <h3>{{ $todayMoods }}</h3>
            <p>Mood Hôm Nay</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon">
            <i class="bi bi-tags-fill"></i>
        </div>
        <div class="stat-content">
            <h3>{{ $activeMoods }}</h3>
            <p>Mood Types Active</p>
        </div>
    </div>
</div>

<div class="recent-activity">
    <h2 class="section-title">
        <i class="bi bi-activity"></i>
        Hoạt động gần đây
    </h2>

    <div class="activity-list">
        <div class="activity-item">
            <div class="activity-icon">
                <i class="bi bi-person-plus"></i>
            </div>
            <div class="activity-content">
                <p>User mới đăng ký</p>
                <small>{{ now()->format('d/m/Y H:i') }}</small>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon">
                <i class="bi bi-emoji-smile"></i>
            </div>
            <div class="activity-content">
                <p>Mood log mới được tạo</p>
                <small>{{ now()->format('d/m/Y H:i') }}</small>
            </div>
        </div>
    </div>
</div>
@endsection