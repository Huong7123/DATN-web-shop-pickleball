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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->constrained();
            $table->string('user_name');
            $table->string('user_phone');
            $table->string('description')->nullable();
            $table->string('address');
            $table->tinyInteger('shipping_method'); // 0: free | 1: express
            $table->decimal('shipping_fee', 15, 2)->default(0);
            $table->decimal('discount', 15, 2);
            $table->decimal('total', 15, 2)->default(0);
            $table->string('payment_method'); 
            // cod | momo | vnpay | zalopay | bank

            $table->string('payment_status'); 
            // unpaid | paid

            $table->string('status')->default('pending'); 
            // pending | confirm | shipping | completed | canceled
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
