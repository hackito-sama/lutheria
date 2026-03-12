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
        Schema::table('product_standard', function (Blueprint $table) {
            $table->boolean('flg')->default(true)->after('description'); // flag de visibilidad o estado
            $table->string('code')->nullable()->after('flg'); // código único del producto
        });
    }

    public function down(): void
    {
        Schema::table('product_standard', function (Blueprint $table) {
            $table->dropColumn(['flg', 'code']);
        });
    }
};
