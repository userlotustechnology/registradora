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
        Schema::table('end_customers', function (Blueprint $table) {
            $table->decimal('available_balance', 15, 2)->default(0)->after('document')
                ->comment('Saldo disponível (PIX + Boleto)');
            $table->decimal('credit_balance', 15, 2)->default(0)->after('available_balance')
                ->comment('Saldo de crédito (Cartão de Crédito)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('end_customers', function (Blueprint $table) {
            $table->dropColumn(['available_balance', 'credit_balance']);
        });
    }
};
