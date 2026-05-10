@extends('admin.layouts.app')

@section('title', 'Quản lý nội dung AI')

@section('content')
<div class="content-header">
    <h1>Quản lý nội dung AI</h1>
    <p>Quản lý các prompts và nội dung được tạo bởi AI.</p>
</div>

@if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div style="margin-bottom: 1.5rem; text-align: right;">
        <a href="{{ route('admin.prompts.create') }}" class="action-btn" style="background-color: #2d3748; color: white; text-decoration: none;">Thêm Prompt mới</a>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Loại Prompt</th>
                    <th>Nội dung Prompt (gốc)</th>
                    <th>Version</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prompts as $prompt)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td><strong>{{ $prompt->prompt_type }}</strong></td>

                    <td style="max-width: 400px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ Str::words($prompt->content, 20, '...') }}
                    </td>
                    <td>v{{ $prompt->version }}</td>
                    <td>
                        <a href="{{ route('admin.prompts.show', $prompt) }}" class="action-btn" style="text-decoration: none;">Xem</a>
                        <a href="{{ route('admin.prompts.edit', $prompt) }}" class="action-btn" style="text-decoration: none;">Sửa</a>
                        <form action="{{ route('admin.prompts.destroy', $prompt) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa prompt này không?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn" style="color: #c53030;">Xóa</button>
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
    <div style="margin-top: 1.5rem;">{{ $prompts->links() }}</div>
</div>
@endsection
