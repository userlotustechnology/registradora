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
            $table->string('payment_type')->nullable()->after('order_reference')
                ->comment('Tipo de pagamento: Para crédito (pix, boleto, cartao_credito, outro). Para débito (estorno_total, estorno_parcial, chargeback, taxa)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('value_records', function (Blueprint $table) {
            $table->dropColumn('payment_type');
        });
    }
};
