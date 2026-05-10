@extends('admin.layouts.app')

@section('title', 'Thêm Mood mới')

@section('content')
<div class="content-header">
    <h1>Thêm Mood mới</h1>
    <p>Tạo một loại cảm xúc mới cho người dùng lựa chọn.</p>
</div>

<div class="card">
    <form action="{{ route('admin.moods.store') }}" method="POST">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div>
                <div class="form-group">
                    <label for="label">Tên Mood</label>
                    <input type="text" id="name" name="label" class="form-control" value="{{ old('label') }}" required>
                    @error('label') <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="code">Mood Code (dùng cho AI, viết liền không dấu)</label>
                    <input type="text" id="code" name="code" class="form-control" value="{{ old('code') }}" required placeholder="vi-du: rat_vui">
                    @error('code') <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                </div>
                
                <div class="form-group">
                    <label for="ai_tone">AI_tone</label>
                    <input type="text" id="ai_tone" name="ai_tone" class="form-control" value="{{ old('ai_tone') }}" required placeholder="vi-du: calm">
                    @error('ai_tone') <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <div class="form-group">
                    <label for="emoji">Emoji</label>
                    <input type="text" id="emoji" name="emoji" class="form-control" value="{{ old('emoji') }}" required placeholder="😄">
                    @error('emoji') <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="color">Mã màu (Hex)</label>
                    <input type="text" id="color" name="color" class="form-control" value="{{ old('color', '#FBBF24') }}" required placeholder="#FBBF24">
                    @error('color') <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div style="margin-top: 1.5rem; text-align: right;">
            <a href="{{ route('admin.moods.index') }}" class="action-btn" style="text-decoration: none;">Hủy</a>
            <button type="submit" class="action-btn" style="background-color: #2d3748; color: white;">Lưu Mood</button>
        </div>
    </form>
</div>
@endsection