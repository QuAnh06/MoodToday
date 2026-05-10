@extends('admin.layouts.app')

@section('title', 'Quản lý người dùng')

@section('content')
<div class="content-header">
    <h1>Quản lý người dùng</h1>
    <p>Xem, tìm kiếm và quản lý tất cả người dùng trong hệ thống.</p>
</div>

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên người dùng</th>
                    {{-- <th>Zalo ID</th> --}}
                    <th>Ngày tham gia</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><strong>{{ $user->name }}</strong></td>
                    {{-- <td>{{ $user->zalo_id }}</td> --}}
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    {{-- <td>
                        @if($user->status == 'active')
                        <span class="status-badge status-active">Active</span>
                        @else
                        <span class="status-badge status-blocked">Blocked</span>
                        @endif
                    </td> --}}
                    <td>
                        <button class="action-btn">Xem lịch sử</button>
                        <button class="action-btn">Sửa</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Không có người dùng nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="margin-top: 1.5rem;">{{ $users->links() }}</div>
</div>
@endsection
