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
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome do parceiro
            $table->string('email')->unique(); // Email para login
            $table->string('document')->unique(); // CPF ou CNPJ
            $table->string('api_token')->unique(); // Token de autenticação da API
            $table->boolean('is_active')->default(true); // Status ativo/inativo
            $table->timestamps();
            $table->softDeletes(); // Para exclusão lógica
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
