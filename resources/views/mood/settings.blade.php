@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/mood-style.css') }}">
<div class="app-container">
    <div class="main-card p-0 overflow-hidden">
        <div class="p-4 border-bottom">
            <h4 class="fw-bold mb-0">Cài đặt</h4>
        </div>
        <div class="list-group list-group-flush">
            <div class="list-group-item p-4 d-flex justify-content-between align-items-center border-0">
                <span>Nhắc nhở buổi sáng</span>
                <div class="form-check form-switch"><input class="form-check-input" type="checkbox" checked></div>
            </div>
            <div class="list-group-item p-4 d-flex justify-content-between align-items-center border-0 border-top">
                <span>Nhắc nhở buổi tối</span>
                <div class="form-check form-switch"><input class="form-check-input" type="checkbox" checked></div>
            </div>
            <div class="list-group-item p-4 border-0 border-top">
                <span class="text-danger fw-bold">Đăng xuất</span>
            </div>
        </div>
    </div>
</div>
@endsection