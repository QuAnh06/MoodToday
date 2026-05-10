@extends('admin.layouts.app')

@section('title', 'Sửa Mood')

@section('content')
@section('content') 
<div class="content-header">
    <h1>Sửa Mood {{ $mood->name }}</h1>
    <p>Chỉnh sửa thông tin của loại cảm xúc.</p>
</div>

<div class="card">
    <form action="{{ route('admin.moods.update', $mood) }}" method="POST">
        @csrf
        @method('PUT')
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div>
                <div class="form-group">
                    <label for="label">Tên Mood</label>
                    <input type="text" id="label" name="label" class="form-control" value="{{ old('label', $mood->label) }}" required>
                    @error('label') <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="code">Mood Code (dùng cho AI, viết liền không dấu)</label>
                    <input type="code" id="label" name="code" class="form-control" value="{{ old('code', $mood->code) }}" required placeholder="vi-du: rat_vui">
                    @error('code') <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                </div>
                
                <div class="form-group">
                    <label for="ai_tone">AI_tone</label>
                    <input type="text" id="ai_tone" name="ai_tone" class="form-control" value="{{ old('ai_tone', $mood->ai_tone) }}" placeholder="vi-du: rat_vui">
                    @error('ai_tone') <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <div class="form-group">
                    <label for="emoji">Emoji</label>
                    <input type="text" id="emoji" name="emoji" class="form-control" value="{{ old('emoji', $mood->emoji) }}" required placeholder="😄">
                    @error('emoji') <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label for="color">Mã màu (Hex)</label>
                    <input type="text" id="color" name="color" class="form-control" value="{{ old('color', $mood->bg_color) }}" required placeholder="#FBBF24">
                    @error('color') <p style="color: #c53030; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div style="margin-top: 1.5rem; text-align: right;">
            <a href="{{ route('admin.moods.index') }}" class="action-btn" style="text-decoration: none;">Hủy</a>
            <button type="submit" class="action-btn" style="background-color: #2d3748; color: white;">Cập nhật</button>
        </div>
    </form>
</div>
@endsection