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
            $table->string('code')->unique(); 
            $table->string('label');  
            $table->string('emoji');  
            $table->boolean('is_active')->default(true);  
            $table->string('ai_tone')->nullable();  
            $table->string('bg_color')->nullable();
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
