<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // في migration create_order_medications_table.php
public function up()
{
    Schema::create('order_medications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->onDelete('cascade'); 
        $table->foreignId('medication_id')->constrained()->onDelete('cascade'); 
        $table->integer('quantity')->default(1); 
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('order_medications');
}
};
