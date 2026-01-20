<?php
//هذا الملف الجديد الخاص ب orders
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
        $table->string('customer_name');  // اسم الزبون
        $table->string('customer_phone'); // رقم الهاتف
        $table->string('address')->nullable(); // العنوان
        $table->decimal('total_amount', 10, 2); // المبلغ الإجمالي
        $table->string('status')->default('pending'); // حالة الطلب (قيد الانتظار)
        $table->string('session_id')->nullable(); // لنعرف من صاحب الطلب
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
