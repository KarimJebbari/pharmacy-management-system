<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cmd', function (Blueprint $table) {
            $table->id(); 
            $table->string('customer_name'); 
            $table->string('address'); 
            $table->string('phone'); 
            $table->string('prescription'); 
            $table->json('medications'); 
            $table->decimal('total_price', 10, 2); 
            $table->enum('status', ['En attente', 'Validé', 'Refusé'])->default('En attente'); 
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cmd');
    }
};
