@extends('layouts.app')

@section('title', 'Tình yêu hôm nay bao nhiêu %')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/love-percent/love-percent.css') }}">
@endpush

@section('content')
<div class="app-container app-love-percent pt-4 pb-5">
    <a href="{{ route('home', ['tab' => 'menu']) }}" class="btn-back animate-reveal text-decoration-none">
        <i class="bi bi-arrow-left"></i> Back
    </a>


    <div class="page-header animate-reveal delay-1">
        <div class="love-header-icon">
            <i class="bi bi-sparkles"></i> </div>
        <p class="text-muted-healing mb-2">Tình yêu hôm nay bao nhiêu %</p>
        <h1 class="fw-800 text-deep-dark mb-2">Kiểm tra duyên số ngay</h1>
        <p class="text-muted-healing">Nhập thông tin của bạn và crush để AI bói một cách nhẹ nhàng.</p>
    </div>

    <form action="{{ route('store') }}" method="POST">
        @csrf
        
        <div class="love-duo animate-reveal delay-2">
            <div class="love-card card-monex card-healing">
                <div class="love-card-header">
                    <i class="bi bi-person-fill text-sage"></i>
                    <div class="love-card-title text-deep-dark fw-bold">Thông tin bạn</div>
                </div>
                <label class="form-label text-muted-healing">Họ tên</label>
                <input type="text" name="name1" class="form-control-healing @error('name1') is-invalid @enderror" 
                    placeholder="Nhập họ tên của bạn" value="{{ old('name1') }}" required>
                
                @error('name1')
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror

                    <label class="form-label text-muted-healing mt-3">Ngày sinh</label>
                <input type="date" name="dob1" class="form-control-healing">
            </div>

            <div class="love-card card-monex card-healing card-healing-light">
                <div class="love-card-header">
                    <i class="bi bi-heart-half text-teal"></i>
                    <div class="love-card-title text-deep-dark fw-bold">Thông tin crush</div>
                </div>
                <label class="form-label text-muted-healing">Họ tên</label>
                <input type="text" name="name2" class="form-control-healing @error('name2') is-invalid @enderror" 
                    placeholder="Nhập họ tên crush" value="{{ old('name2') }}" required>
                
                @error('name2')
                    <div class="invalid-feedback"> {{ $message }} </div>
                @enderror

                <label class="form-label text-muted-healing mt-3">Ngày sinh</label>
                <input type="date" name="dob2" class="form-control-healing">
            </div>
        </div>

        <button type="submit" class="btn-monex-premium btn-healing w-100 mt-4 animate-reveal delay-3">
            <i class="bi bi-magic me-2"></i> Bói tình yêu ngay
        </button>
    </form>
    </div>
@endsection