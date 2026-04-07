@extends('layouts.admin')

@section('title', 'Quản lý Mood Types')

@section('content')
<div class="admin-header">
    <h1 class="page-title">
        <i class="bi bi-emoji-expressionless"></i>
        Quản lý Mood Types
    </h1>
    <p class="page-subtitle">Danh sách các loại cảm xúc trong hệ thống</p>
</div>

<div class="data-table-container">
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Emoji</th>
                    <th>Label</th>
                    <th>AI Tone</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($moods as $mood)
                <tr>
                    <td>{{ $mood->id }}</td>
                    <td><code>{{ $mood->code }}</code></td>
                    <td class="emoji-cell">{{ $mood->emoji }}</td>
                    <td>{{ $mood->label }}</td>
                    <td>{{ $mood->ai_tone }}</td>
                    <td>
                        <span class="status-badge {{ $mood->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $mood->is_active ? 'Hoạt động' : 'Tạm dừng' }}
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
        {{ $moods->links() }}
    </div>
</div>
@endsection