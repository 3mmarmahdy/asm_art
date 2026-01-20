<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('price', 8, 2);
        $table->integer('quantity')->default(1);
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        
        // هذا هو السطر الجديد والمهم جداً للربط
        // يقوم بإنشاء عمود category_id ويربطه بجدول categories
        $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
        
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
