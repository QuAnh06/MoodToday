@extends('admin.layouts.app')

@section('title', 'Thêm Prompt mới')

@section('content')
<div class="content-header">
    <h1>Thêm Prompt mới</h1>
    <p>Tạo một prompt mới để AI sử dụng.</p>
</div>

<div class="card">
    <form action="{{ route('admin.prompts.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="prompt_type">Loại Prompt</label>
            <input type="text" id="type" name="prompt_type" class="form-control" value="{{ old('prompt_type') }}" required placeholder="Ví dụ: general_advice, positive_affirmation...">
            @error('prompt_type') <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            {{-- <label for="mood_id">Mood liên quan (Tùy chọn)</label>
            <select name="mood_id" id="mood_id" class="form-control">
                <option value="">Không có</option>
                @foreach($moods as $mood)
                    <option value="{{ $mood->id }}" {{ old('mood_id') == $mood->id ? 'selected' : '' }}>{!! $mood->emoji !!} {{ $mood->name }}</option>
                @endforeach
            </select>
            @error('mood_id') <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror --}}
        </div>

        <div class="form-group">
            <label for="content">Nội dung Prompt</label>
            <textarea name="content" id="content" rows="8" class="form-control" required>{{ old('content') }}</textarea>
            @error('content') <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label for="version">Version</label>
            <input type="number" id="version" name="version" class="form-control" value="{{ old('version', 1) }}" required min="1">
            @error('version') <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
        </div>

        <div style="margin-top: 1.5rem; text-align: right;">
            <a href="{{ route('admin.prompts.index') }}" class="action-btn" style="text-decoration: none;">Hủy</a>
            <button type="submit" class="action-btn" style="background-color: #2d3748; color: white;">Lưu Prompt</button>
        </div>
    </form>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
@endsection