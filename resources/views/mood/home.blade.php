@extends('layouts.app')

@section('content')
<div class="app-container py-3">

    <div class="pt-2 pb-5 px-1">
        <div class="animate-reveal text-center mb-4">
            <h4 class="fw-800">Chào, {{ $userName ?? 'bạn' }}! 👋</h4>
            <p class="text-muted small">Khám phá bản thân mỗi ngày cùng AI.</p>
        </div>

        <div class="glass-monex border-0 animate-reveal delay-1" style="background: linear-gradient(135deg, #FF9F1C 0%, #FF6B35 100%); color: white;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <p class="small opacity-75 mb-0 text-uppercase fw-bold">Chuỗi ngày</p>
                    <h1 class="fw-800 mb-0" style="font-size: 3rem; letter-spacing: -2px;">{{ $streak }} 🔥</h1>
                    <p class="small opacity-75 mt-1 mb-0">{{ ($checkinToday ?? false) ? 'Hôm nay đã check-in!' : 'Hôm nay chưa check-in!' }}</p>
                </div>
                <div class="flame-icon-large">
                    <i class="bi bi-fire" style="font-size: 5rem; color: rgba(255,255,255,0.2);"></i>
                </div>
            </div>
        </div>


        <div class="glass-monex animate-reveal delay-2">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0">Chặng đường thấu hiểu</h6>
                <span class="badge rounded-pill fw-bold px-3 py-2" style="background: #EBFBEE; color: var(--duo-green);">Cấp độ 2</span>
            </div>
            <div class="duo-progress">
                @php
                    $progress = ($streak ?? 0) % 3;
                    $progressWidth = max(20, min(100, 20 + ($progress * 30)));
                @endphp
                <div class="duo-progress-bar" style="width: {{ $progressWidth }}%"></div>
            </div>
            <p class="text-muted small mt-2 mb-0">Còn {{ 3 - (($streak ?? 0) % 3) }} ngày nữa để mở khóa huy hiệu mới!</p>
            <!-- Biểu đồ check-in từng ngày -->
            <div class="mt-4">
                <canvas id="checkinChart" height="120"></canvas>
            </div>
        </div>

        <div class="animate-reveal delay-3 mb-5">
            <a href="{{ route('mood.checkin-ai') }}" class="{{ request()->RouteIs('mood.checkin-ai') ? 'active' : '' }}btn-start d-flex align-items-center justify-content-center py-4 text-decoration-none shadow-lg">
                <i class="bi bi-stars me-2 fs-3"></i> 
                <span class="fs-5fw-bold">BẮT ĐẦU CHECK-IN NGAY</span>
            </a>
        </div>

        <div class="row g-3 animate-reveal delay-4">
            <div class="col-4">
                <div class="glass-monex h-100 p-3 text-center border-0 shadow-sm">
                    <i class="bi bi-trophy-fill text-warning fs-1"></i>
                    <p class="fw-bold small mt-2 mb-0">Vua Streak</p>
                </div>
            </div>
            <div class="col-4">
                <div class="glass-monex h-100 p-3 text-center border-0 shadow-sm opacity-50">
                    <i class="bi bi-moon-stars-fill text-primary fs-1"></i>
                    <p class="fw-bold small mt-2 mb-0">Night Owl</p>
                </div>
            </div>
            <div class="col-4">
                <div class="glass-monex h-100 p-3 text-center border-0 shadow-sm opacity-50">
                    <i class="bi bi-chat-heart-fill text-danger fs-1"></i>
                    <p class="fw-bold small mt-2 mb-0">AI Friend</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var ctx = document.getElementById('checkinChart').getContext('2d');
    var checkinChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chartLabels ?? []),
            datasets: [{
                label: 'Check-in',
                data: @json($chartData ?? []),
                backgroundColor: 'rgba(45, 91, 255, 0.7)',
                borderRadius: 12,
                maxBarThickness: 32
            }]
        },
        options: {
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { weight: 'bold' } }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: '#E2E8F0' },
                    ticks: { display: false }
                }
            }
        }
    });
});
</script>
@endpush