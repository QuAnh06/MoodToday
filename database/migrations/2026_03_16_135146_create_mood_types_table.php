<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mood_types', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // happy, sad, tired... 
            $table->string('label'); // Vui, Buồn, Mệt... 
            $table->string('emoji'); // Emoji hiển thị 
            $table->boolean('is_active')->default(true); // Bật/tắt mood 
            $table->string('ai_tone')->nullable(); // Tone giọng AI cho mood này 
            $table->string('bg_color')->nullable(); // Màu nền cho UI (bổ sung cho đẹp)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mood_types');
    }
};
