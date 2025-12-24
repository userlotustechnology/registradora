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
        Schema::create('value_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partner_id')->constrained('partners')->onDelete('cascade'); // Parceiro que fez o registro
            $table->foreignId('end_customer_id')->constrained('end_customers')->onDelete('cascade'); // Cliente final
            $table->decimal('total_amount', 15, 2); // Valor total
            $table->enum('transaction_type', ['credit', 'debit']); // Tipo: crédito ou débito
            $table->integer('installments')->default(1); // Quantidade de parcelas
            $table->decimal('installment_amount', 15, 2); // Valor de cada parcela
            $table->text('description')->nullable(); // Descrição opcional
            $table->timestamps();
            $table->softDeletes(); // Para exclusão lógica
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('value_records');
    }
};
