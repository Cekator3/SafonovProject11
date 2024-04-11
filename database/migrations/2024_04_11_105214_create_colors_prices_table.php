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
        Schema::create('colors_prices', function (Blueprint $table)
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('model_id');
            $table->smallInteger('color_id');

            // Indexes
            $table->unique(['model_id', 'color_id']);

            // Foreign Keys
            $table->foreign('model_id')
                  ->references('id')->on('models')
                  ->cascadeOnDelete();
            $table->foreign('color_id')
                  ->references('id')->on('colors')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colors_prices');
    }
};
