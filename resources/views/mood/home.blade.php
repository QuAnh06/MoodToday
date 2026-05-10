@extends('layouts.app')

@section('title', 'Home')

@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/mood/mood-style.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/mood/home-style.css') }}">
@endpush

@section('content')
@php
    $activeTab = request('tab', 'home');
@endphp

<div class="app-container pt-4 pb-5">
    @if ($activeTab === 'home')
        <div class="home-hero animate-reveal">
            <div class="hero-welcome">
                <p class="hero-greeting">Welcome <span class="hero-you">bạn</span>,</p>
                <h1 class="hero-name">{{ $userName }}!</h1>
            </div>

            <div class="week-strip animate-reveal delay-1">
                @foreach ($weekDays as $day)
                    <div class="week-pill {{ $day['isToday'] ? 'active' : '' }}">
                        <span class="day-label">{{ $day['label'] }}</span>
                        <strong>{{ $day['date'] }}</strong>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="home-card mood-entry-card animate-reveal delay-2">
            <form action="{{ route('mood.store') }}" method="POST">
                @csrf
                <div class="mood-card-top">
                    <h2 class="mood-card-title">How are you feeling?</h2>
                    <div class="mood-pill-row">
                        @forelse ($moodTypes as $mood)
                            <label class="mood-pill">
                                <input type="radio" name="mood_id" value="{{ $mood->id }}" required>
                                <span class="emoji">{{ $mood->emoji }}</span>
                                <span class="emoji-label">{{ $mood->label }}</span>
                            </label>
                        @empty
                            <p class="text-muted">Vui lòng thử lại!</p>
                        @endforelse
                    </div>
                </div>

                <textarea name="user_text" class="form-control-monex home-textarea mt-4" rows="3" placeholder="Write how you're feeling..." required>{{ old('user_text') }}</textarea>
                <button type="submit" class="btn-monex-premium w-100 mt-3">Send Mood</button>
            </form>
        </div>

        <div class="journal-preview animate-reveal delay-3">
            <div class="section-header">
                <div>
                    <h4 class="fw-bold text-deep-dark mb-0">My Journal</h4>
                    <p>Nhật ký cảm xúc gần đây</p>
                </div>
                <a href="{{ route('diary') }}" class="link-more">See All >></a>
            </div>

            <div class="swiper journal-slider">
                <div class="swiper-wrapper">
                    
                    @forelse ($recentLogs as $log)
                    <div class="swiper-slide">
                        <div class="journal-card-custom">
                            <div class="journal-card-top">
                                <span class="journal-date">{{ $log->created_at->translatedFormat('d M Y') }}</span>
                                @if($log->moodType)
                                <span class="journal-mood-chip">
                                    <span>{{ $log->moodType->emoji }}</span>
                                    {{ $log->moodType->label }}
                                </span>
                                @endif
                            </div>

                            <div class="journal-content">
                                <p>{{ \Illuminate\Support\Str::limit($log->user_text ?? "Bạn đã ghi lại cảm xúc: " . $log->moodType?->label, 140) }}</p>
                            </div>

                            <a href="{{ route('mood.result', ['log_id' => $log->id]) }}" class="show-more-btn">
                                Show More <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="swiper-slide">
                        <div class="journal-card-custom journal-card-empty">
                            <p class="text-muted opacity-70">Bạn chưa có nhật ký nào! Ghi tâm trạng hôm nay để xem gợi ý cảm xúc nhé.</p>
                        </div>
                    </div>
                    @endforelse

                    @if (!empty($hasMoreLogs) && $hasMoreLogs)
                    <div class="swiper-slide">
                        <a href="{{ route('diary') }}" class="journal-card-custom journal-card-more">
                            <div class="more-icon">...</div>
                            <div class="more-text">
                                <strong>Xem thêm nhật ký</strong>
                                <p>Đã có nhiều entries hơn. Chạm vào đây để xem toàn bộ hành trình cảm xúc của bạn.</p>
                            </div>
                        </a>
                    </div>
                    @endif

                </div>
            </div>
        </div>

        {{-- MOODCHART --}}
        <div class="mood-chart-section mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3 px-2">
                <h4 class="fw-bold text-deep-dark mb-0">Mood Chart</h4>

                <div class="custom-dropdown-container">
                    <div class="mood-select-box" id="dropdownToggle">
                        <select id="timeframeSelect">
                            <option value="7days" {{ $timeframe == '7days' ? 'selected' : '' }}>7 ngày qua</option>
                            <option value="1month" {{ $timeframe == '1month' ? 'selected' : '' }}>1 tháng qua</option>
                            <option value="3months" {{ $timeframe == '3months' ? 'selected' : '' }}>3 tháng qua</option>
                            <option value="6months" {{ $timeframe == '6months' ? 'selected' : '' }}>6 tháng qua</option>
                        </select>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                </div>
            </div>

            <div class="mood-chart-card" id="chart-wrapper">
                @include('mood._chart')
            </div>
        </div>

        <script>
            document.getElementById('timeframeSelect').addEventListener('change', function() {
                let timeframe = this.value;
                let wrapper = document.getElementById('chart-wrapper');

                wrapper.style.opacity = '0.5';

                fetch(`{{ route('home') }}?timeframe=${timeframe}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        wrapper.innerHTML = html; 
                        wrapper.style.opacity = '1';

                        setTimeout(() => {
                            let fills = wrapper.querySelectorAll('.bar-progress');
                            fills.forEach(f => f.style.transition = 'height 1s ease');
                        }, 10);
                    });
            });

        </script>




    @else
        <div class="menu-intro animate-reveal delay-1">
            <h2>Moodlytics</h2>
            <p class="menu-intro-copy">Khám phá các công cụ giúp bạn kết nối với cảm xúc, gửi tin nhắn crush và lưu lại nhật ký mỗi ngày.</p>
        </div>
        <div class="menu-grid animate-reveal delay-2">
            <a href="{{ route('crush.index') }}" class="menu-card card-primary">
                <div class="menu-card-top">
                    <div class="menu-card-icon"><i class="bi bi-chat-left-text-fill"></i></div>
                </div>
                <div>
                    <h5>AI giải mã tin nhắn crush</h5>
                    <p class="menu-card-copy">Dán đoạn chat để nhận gợi ý cảm xúc và ý định ẩn sau lời nhắn.</p>
                </div>
                <span class="menu-card-arrow"><i class="bi bi-arrow-right-short"></i></span>
            </a>
            <a href="{{ route('love.percent') }}" class="menu-card card-secondary">
                <div class="menu-card-top">
                    <div class="menu-card-icon"><i class="bi bi-heart-pulse-fill"></i></div>
                </div>
                <div>
                    <h5>Tình yêu hôm nay bao nhiêu %</h5>
                    <p class="menu-card-copy">Nhập thông tin nhanh và xem duyên số của bạn với crush ngay hôm nay.</p>
                </div>
                <span class="menu-card-arrow"><i class="bi bi-arrow-right-short"></i></span>
            </a>
            <a href="{{ route('diary') }}" class="menu-card card-tertiary">
                <div class="menu-card-top">
                    <div class="menu-card-icon"><i class="bi bi-journal-text"></i></div>
                </div>
                <div>
                    <h5>Nhật kí cảm xúc</h5>
                    <p class="menu-card-copy">Xem lại hành trình tâm trạng, cảm xúc nổi bật và những ngày ý nghĩa.</p>
                </div>
                <span class="menu-card-arrow"><i class="bi bi-arrow-right-short"></i></span>
            </a>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.journal-slider', {
            slidesPerView: 'auto',
            spaceBetween: 16,
            grabCursor: true,
            freeMode: true,
            centeredSlides: false,
            breakpoints: {
                640: {
                    slidesPerView: 'auto',
                },
                900: {
                    slidesPerView: 'auto',
                }
            }
        });
    });
</script>

@endsection