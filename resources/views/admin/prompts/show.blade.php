@extends('admin.layouts.app')

@section('title', 'Chi tiết Prompt')

@section('content')
<div class="content-header">
    <h1>Chi tiết Prompt #{{ $prompt->id }}</h1>
    <p>Xem thông tin chi tiết của prompt.</p>
</div>

<div class="card">
    <div style="display: grid; grid-template-columns: 150px 1fr; gap: 1rem 2rem; align-items: start;">
        <strong style="color: var(--text-secondary);">ID</strong>
        <div>{{ $prompt->id }}</div>

        <strong style="color: var(--text-secondary);">Loại Prompt</strong>
        <div>{{ $prompt->prompt_type }}</div>

        

        <strong style="color: var(--text-secondary);">Version</strong>
        <div>v{{ $prompt->version }}</div>

        <strong style="color: var(--text-secondary);">Ngày tạo</strong>
        <div>{{ $prompt->created_at->format('H:i d/m/Y') }}</div>

        <strong style="color: var(--text-secondary);">Nội dung</strong>
        <div style="white-space: pre-wrap; background-color: #f4f7fa; padding: 1rem; border-radius: 8px; font-family: monospace; line-height: 1.6;">{{ $prompt->content }}</div>
    </div>

    <div style="margin-top: 2rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem; text-align: left;">
        <a href="{{ route('admin.prompts.index') }}" class="action-btn" style="text-decoration: none;">Quay lại danh sách</a>
        <a href="{{ route('admin.prompts.edit', $prompt) }}" class="action-btn" style="background-color: #2d3748; color: white; text-decoration: none;">Sửa Prompt</a>
    </div>
</div>
@endsection