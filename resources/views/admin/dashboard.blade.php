@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="content-header">
    <h1>Dashboard</h1>
    <p>Tổng quan về hoạt động của ứng dụng MoodToday.</p>
</div>

<div class="stat-grid">
    <div class="card stat-card">
        <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
        <h3 class="stat-value">{{ number_format($totalUsers) }}</h3>
        <p class="stat-label">Tổng số người dùng</p>
    </div>
    <div class="card stat-card">
        <div class="stat-icon"><i class="bi bi-person-check-fill"></i></div>
        <h3 class="stat-value">{{ number_format($usersActiveToday) }} / {{ number_format($usersActive7Days) }}</h3>
        <p class="stat-label">Active hôm nay / 7 ngày</p>
    </div>
    <div class="card stat-card">
        <div class="stat-icon"><i class="bi bi-journal-text"></i></div>
        <h3 class="stat-value">{{ number_format($totalMoodLogs) }}</h3>
        <p class="stat-label">Tổng số mood log</p>
    </div>
    <div class="card stat-card">
        <div class="stat-icon">{!! $popularMood->emoji ?? '<i class="bi bi-star-fill"></i>' !!}</div>
        <h3 class="stat-value" style="font-size: 1.75rem;">{{ $popularMood->label ?? 'Chưa có' }}</h3>
        <p class="stat-label">Mood phổ biến hôm nay</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; align-items: flex-start;">
    <!-- Mood Chart -->
    <div class="card">
        <h4>Biểu đồ Mood theo ngày (7 ngày qua)</h4>
        <div class="table-wrapper">
            <table style="font-size: 0.9rem;">
                <thead>
                    <tr>
                        <th>Ngày</th>
                        @foreach($moods as $mood)
                            <th style="text-align: center;">{!! $mood->emoji !!}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>

                    @foreach($dates as $date)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($date)->format('d/m') }}</td>

                        @foreach($moods as $mood)
                        @php
                        //Lấy nhóm dữ liệu của ngày đó
                        $dailyData = $moodChartData->get($date);

                        //Lấy bản ghi của mood_id cụ thể
                        $moodRecord = $dailyData ? $dailyData->get($mood->id) : null;

                        $count = $moodRecord ? $moodRecord->count : 0;
                        @endphp

                        <td style="text-align: center; font-weight: 600; color: {{ $count > 0 ? '#2d3748' : '#cbd5e0' }};">
                            {{ $count > 0 ? $count : 0 }}
                        </td>
                        @endforeach
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <p style="font-size: 0.8rem; color: #718096; margin-top: 1rem;">*</p>
    </div>

    <!-- Peak Hours -->
    <div class="card">
        <h4>Giờ hoạt động cao điểm</h4>
        <ul style="list-style: none; padding: 0; margin: 0;">
            @forelse($peakHours as $hour)
            <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #e2e8f0;">
                <span style="font-weight: 600;">
                    <i class="bi bi-clock-fill" style="color: #a0aec0; margin-right: 0.5rem;"></i>
                    {{ $hour->hour }}:00 - {{ $hour->hour + 1 }}:00
                </span>
                <span style="font-weight: 700; font-size: 1.1rem;">{{ $hour->count }} logs</span>
            </li>
            @empty
            <p>Chưa có dữ liệu.</p>
            @endforelse
        </ul>
    </div>
</div>
@endsection
