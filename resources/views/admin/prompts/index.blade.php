@extends('layouts.admin')

@section('title', 'Quản lý AI Prompts')

@section('content')
<div class="admin-header">
    <h1 class="page-title">
        <i class="bi bi-robot"></i>
        Quản lý AI Prompts
    </h1>
    <p class="page-subtitle">Danh sách các prompt cho AI trong hệ thống</p>
</div>

<div class="data-table-container">
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mood Type</th>
                    <th>Loại Prompt</th>
                    <th>Nội dung</th>
                    <th>Version</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prompts as $prompt)
                <tr>
                    <td>{{ $prompt->id }}</td>
                    <td>{{ $prompt->mood_id ? $prompt->moodType->label : 'Global' }}</td>
                    <td>
                        <span class="prompt-type-badge {{ 'type-' . $prompt->prompt_type }}">
                            {{ ucfirst($prompt->prompt_type) }}
                        </span>
                    </td>
                    <td class="content-cell">{{ Str::limit($prompt->content, 80) }}</td>
                    <td><code>{{ $prompt->version }}</code></td>
                    <td>
                        <span class="status-badge {{ $prompt->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $prompt->is_active ? 'Hoạt động' : 'Tạm dừng' }}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-action btn-view" title="Xem chi tiết">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button class="btn-action btn-edit" title="Chỉnh sửa">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination-container">
        {{ $prompts->links() }}
    </div>
</div>
@endsection