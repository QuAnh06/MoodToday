@extends('layouts.app')
@section('content')
<div class="app-container pt-4">
    <h4 class="fw-800 mb-4 animate-reveal">Phân tích cảm xúc</h4>

    <div class="history-chart-card animate-reveal delay-1">
        <h6 class="fw-bold mb-3 small text-muted text-uppercase">Xu hướng 7 ngày qua</h6>
        <canvas id="moodChart" height="200"></canvas>
    </div>

    <h6 class="fw-bold mb-3 px-2">Lịch sử gần đây</h6>
    <div class="animate-reveal delay-2">
        @forelse ($recentLogs as $log)
            <a href="{{ route('mood.result', ['log_id' => $log->id]) }}" class="monex-card d-flex align-items-center mb-3 text-decoration-none text-dark">
                <div class="fs-2 me-3">{{ $log->moodType?->emoji }}</div>
                <div class="flex-grow-1">
                    <h6 class="mb-0 fw-bold small">{{ $log->created_at->format('d/m') }} - {{ $log->created_at->format('H:i') }}</h6>
                    <p class="mb-0 text-muted small">{{ $log->moodType?->label }}</p>
                </div>
                <i class="bi bi-chevron-right text-muted"></i>
            </a>
        @empty
            <div class="text-muted small">Chưa có lịch sử check-in.</div>
        @endforelse
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('moodChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Số lần check-in',
                data: @json($chartData),
                borderColor: '#2D5BFF',
                backgroundColor: 'rgba(45, 91, 255, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: '#2D5BFF'
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { display: false },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endsection