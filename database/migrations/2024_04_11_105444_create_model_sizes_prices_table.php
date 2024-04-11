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
        Schema::create('model_sizes_prices', function (Blueprint $table)
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('model_id');
            $table->integer('model_size_id');

            // Indexes
            $table->unique(['model_id','model_size_id']);

            // Foreign Keys
            $table->foreign('model_id')
                  ->references('id')->on('models')
                  ->cascadeOnDelete();
            $table->foreign('model_size_id')
                  ->references('id')->on('models_sizes')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('model_sizes_prices');
    }
};
