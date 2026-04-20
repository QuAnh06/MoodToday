<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('mood_logs', function (Blueprint $table) {
            // nullable() để xử lý trường hợp người dùng gửi mood nhưng không viết text
            $table->text('user_text')->nullable()->after('mood_id'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mood_logs', function (Blueprint $table) {
            $table->dropColumn('user_text');
        });
    }
};
