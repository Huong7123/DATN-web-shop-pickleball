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
        Schema::create('exclusive_config_discount', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exclusive_config_id');
            $table->unsignedBigInteger('discount_id');
            $table->timestamps(); // Có thể thêm nếu muốn theo dõi thời gian gắn mã
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exclusive_config_discount');
    }
};
