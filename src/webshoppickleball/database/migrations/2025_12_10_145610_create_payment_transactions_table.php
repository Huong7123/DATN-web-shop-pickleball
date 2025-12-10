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
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->integer('amount');
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->string('payment_method')->default('vnpay');
            $table->string('vnp_response_code')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('vnp_create_date', 14)->nullable()->after('created_at');
            $table->json('payload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_transactions');
    }
};
