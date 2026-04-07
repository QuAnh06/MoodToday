@extends('layouts.app')
@section('content')
<div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="spinner-grow text-primary" style="width: 4rem; height: 4rem;" role="status"></div>
    <h5 class="mt-4 fw-bold">AI đang nghĩ cho bạn...</h5>
    <p class="text-muted small">Đợi một chút để mình pha chế cảm xúc nhé!</p>
</div>
<script>
    // Giả lập loading 2s rồi chuyển sang trang kết quả
    setTimeout(() => { window.location.href = "{{ route('mood.result', ['log_id' => $log_id]) }}"; }, 2000);
</script>
@endsection