<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_standard', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); 
            $table->text('description')->nullable();// Ej: "Headless roja con 2 humbuckers"
            $table->integer('price')->nullable();
            $table->text('images')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_standard');
    }
};
