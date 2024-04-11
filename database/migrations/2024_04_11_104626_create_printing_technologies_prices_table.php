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
        Schema::create('printing_technologies_prices', function (Blueprint $table)
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('model_id');
            $table->smallInteger('printing_technology_id');
            $table->decimal('price', 10, 2);

            // Indexes
            $table->unique(['model_id', 'printing_technology_id']);

            // Foreign Keys
            $table->foreign('model_id')
                  ->references('id')->on('models')
                  ->cascadeOnDelete();
            $table->foreign('printing_technology_id')
                  ->references('id')->on('printing_technologies')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('printing_technologies_prices');
    }
};
