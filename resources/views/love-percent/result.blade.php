@extends('layouts.app')

@section('title', 'Duyên số Tình yêu hôm nay')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/love-percent/love-percent.css') }}">
@endpush

@section('content')

<div class="app-container app-love-result pt-4 pb-5">
    <button type="button" class="btn-back animate-reveal" onclick="history.back();">
        <i class="bi bi-arrow-left"></i> Back
    </button>

    <div class="result-wrapper animate-reveal delay-1">
        <div class="header-info px-4 pt-4 text-center">
            <h4 class="fw-bold text-deep-dark">Kết quả: {{ $data->percent }}%</h4>
            <p class=" text-muted-healing">{{ $data->analysis }}</p>
        </div>

        <div class="love-card-main mx-auto card-monex-main">
            <div class="bubble bubble-1"></div>
            <div class="bubble bubble-2"></div>

            <h4 class="card-title text-deep-dark mt-4 fw-bold">Tình yêu hôm nay</h4>
            
            <div class="couple-row">
                <div class="person">
                    <span class="name text-deep-dark">{{ $log->name1 }}</span>
                    <span class="dob">{{ date('d/m', strtotime($log->dob1)) }}</span>
                </div>
                
                <div class="heart-center text-red">❤️</div>
                
                <div class="person">
                    <span class="name text-deep-dark">{{ $log->name2 }}</span>
                    <span class="dob">{{ date('d/m', strtotime($log->dob2)) }}</span>
                </div>
            </div>

            <div class="score-display text-sage">
                {{ $data->percent }}%
            </div>

            <div class="ai-comment-box shadow-inset">
                <h6 class="fw-bold mb-1 text-deep-dark">Bói tình yêu:</h6>
                <p class="m-0 text-deep-muted">{{ $data->message }}</p>
                <hr>
                <h6 class="fw-bold mb-1 text-deep-dark">Lời Khuyên:</h6>
                <p class="m-0 text-deep-muted">{{ $data->advice }}</p>
            </div>
        </div>
    </div>

    <div class="px-3 animate-reveal delay-2 text-center mt-5">
        <a href="{{ route('love.percent') }}" class="btn-monex-premium btn-healing-outline w-100">
            <i class="bi bi-magic me-2"></i>Tính lại duyên số
        </a>
    </div>

</div>

@endsection