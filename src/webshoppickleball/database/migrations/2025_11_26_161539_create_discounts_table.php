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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('code', 50)->unique();
            $table->text('description')->nullable();

            // 1. Phân loại giảm giá: 'percentage' (%) hoặc 'fixed' (số tiền cụ thể)
            $table->enum('discount_type', ['percentage', 'fixed'])->default('percentage');
            
            // 2. Giá trị giảm (Nếu type là percentage thì lưu 10, 20... Nếu là fixed thì lưu 50000, 100000...)
            $table->decimal('discount_value', 15, 2); 
            
            // 3. Số tiền giảm tối đa (Áp dụng khi dùng percentage, ví dụ: giảm 10% tối đa 50k)
            $table->decimal('max_discount_amount', 15, 2)->nullable();

            // 4. ĐIỀU KIỆN CHI TIÊU
            // Giá trị đơn hàng tối thiểu để được áp dụng mã
            $table->decimal('min_order_value', 15, 2)->default(0);
            
            // Tổng chi tiêu tích lũy của User từ trước đến nay để được dùng mã (Dành cho khách VIP)
            $table->decimal('min_total_spent', 15, 2)->default(0);

            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
