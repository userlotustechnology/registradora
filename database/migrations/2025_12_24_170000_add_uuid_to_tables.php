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
        Schema::table('partners', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->after('id');
            $table->index('uuid');
        });

        Schema::table('end_customers', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->after('id');
            $table->index('uuid');
        });

        Schema::table('value_records', function (Blueprint $table) {
            $table->uuid('uuid')->unique()->after('id');
            $table->index('uuid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropIndex(['uuid']);
            $table->dropColumn('uuid');
        });

        Schema::table('end_customers', function (Blueprint $table) {
            $table->dropIndex(['uuid']);
            $table->dropColumn('uuid');
        });

        Schema::table('value_records', function (Blueprint $table) {
            $table->dropIndex(['uuid']);
            $table->dropColumn('uuid');
        });
    }
};
