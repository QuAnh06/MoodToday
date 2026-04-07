@extends('layouts.app')

@section('title', 'Check-in với AI')

@section('content')
<div class="app-container py-4">
    <div class="text-center animate-reveal mb-4">
        <h2 class="fw-800 mb-2" style="font-size:2.2rem;letter-spacing:-1px;">Check-in với AI 🤖</h2>
        <p class="text-muted">Chia sẻ cảm xúc, AI sẽ lắng nghe và đồng hành cùng bạn mỗi ngày!</p>
    </div>
    <div class="glass-monex p-4 animate-reveal delay-1" style="max-width:480px;margin:0 auto;">
        <form action="{{ route('mood.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <div class="small text-muted mb-2">Chọn emoji cảm xúc</div>
                <div class="d-flex flex-wrap gap-3">
                    @forelse ($moods as $mood)
                        <div>
                            <input
                                class="btn-check"
                                type="radio"
                                name="mood_id"
                                value="{{ $mood->id }}"
                                id="mood-{{ $mood->id }}"
                                required
                            >
                            <label class="btn btn-outline-primary px-3 py-2 rounded-4" for="mood-{{ $mood->id }}" style="min-width:84px;">
                                <span style="font-size:2rem;line-height:1;">{{ $mood->emoji }}</span>
                            </label>
                        </div>
                    @empty
                        <div class="text-muted small">Chưa có mood trong hệ thống. Vui lòng seed dữ liệu mood_types.</div>
                    @endforelse
                </div>
            </div>

            <textarea
                name="user_text"
                class="form-control-monex mb-3"
                rows="4"
                placeholder="Hôm nay bạn cảm thấy thế nào? (chia sẻ vài câu tâm sự)"
                style="resize:none;"
                required
            ></textarea>

            <button type="submit" class="btn-start w-100 d-flex align-items-center justify-content-center">
                <i class="bi bi-robot me-2 fs-4"></i> Gửi cho AI
            </button>
        </form>
    </div>
    <div class="text-center mt-5 animate-reveal delay-2">
        <img src="/images/ai-chat-illustration.svg" alt="AI Chat" style="max-width:220px;filter:drop-shadow(0 8px 32px rgba(45,91,255,0.10));">
        <p class="mt-3 text-muted small">AI sẽ giúp bạn phân tích cảm xúc, đưa ra lời khuyên và động viên GenZ mỗi ngày!</p>
    </div>
</div>
@endsection
