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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->longText('image')->nullable();
            $table->string('name', 255);
            $table->string('slug', 255)->unique();
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->decimal('price', 15, 2)->default(0);
            $table->integer('quantity')->default(0);
            $table->integer('parent_id')->default(0);
            $table->integer('sold')->default(0);

            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
