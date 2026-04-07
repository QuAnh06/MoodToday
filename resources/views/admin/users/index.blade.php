@extends('layouts.admin')

@section('title', 'Quản lý Users')

@section('content')
<div class="admin-header">
    <h1 class="page-title">
        <i class="bi bi-people"></i>
        Quản lý Users
    </h1>
    <p class="page-subtitle">Danh sách tất cả người dùng hệ thống</p>
</div>

<div class="data-table-container">
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Zalo ID</th>
                    <th>Tên</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->zalo_id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>
                        <span class="status-badge {{ $user->status == 'active' ? 'status-active' : 'status-inactive' }}">
                            {{ $user->status == 'active' ? 'Hoạt động' : 'Không hoạt động' }}
                        </span>
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
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
        {{ $users->links() }}
    </div>
</div>
@endsection