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
        Schema::create('credit_card_releases', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('value_record_id')->constrained('value_records')->onDelete('cascade')
                ->comment('Registro de valor relacionado');
            $table->foreignId('end_customer_id')->constrained('end_customers')->onDelete('cascade')
                ->comment('Cliente relacionado');
            $table->decimal('amount', 15, 2)->comment('Valor a ser liberado');
            $table->integer('installment_number')->nullable()->comment('Número da parcela (para installment_flow)');
            $table->date('scheduled_date')->comment('Data programada para liberação');
            $table->boolean('processed')->default(false)->comment('Se já foi processado');
            $table->timestamp('processed_at')->nullable()->comment('Data de processamento');
            $table->timestamps();
            
            $table->index(['scheduled_date', 'processed']);
            $table->index('end_customer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_card_releases');
    }
};
