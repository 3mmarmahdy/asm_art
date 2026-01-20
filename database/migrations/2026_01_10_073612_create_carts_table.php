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
    Schema::create('carts', function (Blueprint $table) {
        $table->id();
        // 1. ربط السلة بالمنتج (إذا حُذف المنتج يُحذف من السلة تلقائياً)
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        
        // 2. الكمية
        $table->integer('quantity')->default(1);
        
        // 3. معرف الجلسة (لنعرف صاحب السلة حتى لو لم يسجل دخول)
        $table->string('session_id')->nullable();
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
