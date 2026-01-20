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
    Schema::table('carts', function (Blueprint $table) {
        // إضافة عمود user_id يقبل قيمة فارغة (للضيوف)
        $table->unsignedBigInteger('user_id')->nullable()->after('id');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('carts', function (Blueprint $table) {
        $table->dropColumn('user_id');
    });
}
};
