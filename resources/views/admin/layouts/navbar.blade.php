<aside class="admin-sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}">MoodToday</a>
    </div>

    <nav class="sidebar-nav">
        <ul class="nav-list">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i> Quản lý người dùng
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.moods.index') }}" class="{{ request()->routeIs('admin.moods.*') ? 'active' : '' }}">
                    <i class="bi bi-emoji-smile-fill"></i> Quản lý Mood
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.prompts.index') }}" class="{{ request()->routeIs('admin.prompts.*') ? 'active' : '' }}">
                    <i class="bi bi-robot"></i> Quản lý nội dung AI
                </a>
            </li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('admin.logout') }}" method="POST">@csrf<button type="submit" class="btn-logout">Đăng xuất</button></form>
    </div>
</aside>

