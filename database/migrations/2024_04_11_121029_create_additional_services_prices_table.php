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
        Schema::create('additional_services_prices', function (Blueprint $table)
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('model_id');
            $table->smallInteger('additional_service_id');
            $table->decimal('price', 10, 2);

            // Indexes
            $table->unique(['model_id', 'additional_service_id']);

            // Foreign Keys
            $table->foreign('model_id')
                  ->references('id')->on('models')
                  ->cascadeOnDelete();
            $table->foreign('additional_service_id')
                  ->references('id')->on('additional_services')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_services_prices');
    }
};
