@extends('layouts.app')

@section('content')

<div class="text-center py-5">
    <div class="glass-card p-4 mx-3 shadow-sm border-0 bg-white">
        <h6 class="text-uppercase text-primary fw-bold mb-3">Tổng kết ngày</h6>
        <h4 class="fw-bold mb-4">Bạn đã vượt qua một ngày khá nặng. Giỏi lắm! 💙</h4>
        <hr class="opacity-10">
        <div class="row text-start mt-4">
            <div class="col-6"><small class="text-muted">Sáng:</small> <p class="fw-bold">Mệt 😴</p></div>
            <div class="col-6"><small class="text-muted">Tối:</small> <p class="fw-bold">Bình thường 😐</p></div>
        </div>
    </div>
    <a href="{{ route('mood.history') }}" class="btn btn-primary-custom mt-4">Xem lại hành trình</a>
</div>

@endsection