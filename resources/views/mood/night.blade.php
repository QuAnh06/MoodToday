@extends('layouts.app')

@section('content')

<div class="glass-card p-5 text-center shadow-lg" style="background: linear-gradient(135deg, #2D3436 0%, #000000 100%); color: white;">
    <h3 class="fw-bold mb-4">Hôm nay bạn thấy sao?</h3>
    <div class="d-flex justify-content-around mb-5">
        <span style="font-size: 2.5rem;">😄</span>
        <span style="font-size: 2.5rem;">😐</span>
        <span style="font-size: 2.5rem;">😴</span>
        <span style="font-size: 2.5rem;">😔</span>
    </div>
    <a href="{{ route('mood.summary') }}" class="btn btn-light rounded-pill px-4 fw-bold text-dark">Lưu lại ngày hôm nay</a>
</div>

@endsection