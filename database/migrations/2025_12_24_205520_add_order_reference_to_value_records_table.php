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
        Schema::table('value_records', function (Blueprint $table) {
            $table->string('order_reference')->nullable()->after('description'); // Referência do pedido relacionado
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('value_records', function (Blueprint $table) {
            $table->dropColumn('order_reference');
        });
    }
};
