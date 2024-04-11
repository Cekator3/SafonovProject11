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
        Schema::create('models', function (Blueprint $table)
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->text('name')->unique();
            $table->text('preview_image');
            $table->text('description');

            // Holed type printing prices
            $table->decimal('price_holed', 10, 2)->nullable();
            $table->decimal('price_not_holed', 10, 2)->nullable();

            // Parted type printing prices
            $table->decimal('price_parted', 10, 2)->nullable();
            $table->decimal('price_not_parted', 10, 2)->nullable();

            // Indexes
            $table->fullText('name')->language('russian');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('models');
    }
};
