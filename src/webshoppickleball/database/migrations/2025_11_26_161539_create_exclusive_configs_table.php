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
        Schema::create('exclusive_configs', function (Blueprint $table) {
            $table->id();
            $table->string('tier_name'); // Ví dụ: Hạng Bạc, Hạng Vàng
            $table->decimal('min_spending', 15, 2)->default(0); // Mức chi tiêu để đạt hạng
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exclusive_configs');
    }
};
