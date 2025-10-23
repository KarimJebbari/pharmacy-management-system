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
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['user_id']); 
        });
    }
    
    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users'); // إعادة إضافة الـ foreign key في حالة التراجع
        });
    }
};
