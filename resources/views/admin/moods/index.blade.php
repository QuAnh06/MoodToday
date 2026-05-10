@extends('admin.layouts.app')

@section('title', 'Quản lý Mood')

@section('content')
<div class="content-header">
    <h1>Quản lý Mood & Dữ liệu cảm xúc</h1>
    <p>Thêm, sửa, xóa và quản lý các loại cảm xúc trong ứng dụng.</p>
</div>

@if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div style="margin-bottom: 1.5rem; text-align: right;">
        <a href="{{ route('admin.moods.create') }}" class="action-btn" style="background-color: #2d3748; color: white; text-decoration: none;">Thêm Mood mới</a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mood</th>
                    <th>Mood Code (dùng cho AI)</th>
                    <th>Label</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($moods as $mood)
                <tr>
                    <td>{{ $mood->id }}</td>
                    <td style="font-size: 1.5rem;" title="{{ $mood->label }}">{!! $mood->emoji !!}</td>
                    <td><code>{{ $mood->code }}</code></td>
                    <td>{{ $mood->label }}</td>
                    <td>
                        @if($mood->is_active)
                        <span class="status-badge status-active">Đang bật</span>
                        @else
                        <span class="status-badge status-blocked">Đã tắt</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.moods.edit', $mood) }}" class="action-btn" style="text-decoration: none;">Sửa</a>
                        <form action="{{ route('admin.moods.toggle', $mood) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="action-btn">
                                {{ $mood->is_active ? 'Tắt' : 'Bật' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Không có dữ liệu.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top: 1.5rem;">{{ $moods->links() }}</div>
</div>
@endsection
