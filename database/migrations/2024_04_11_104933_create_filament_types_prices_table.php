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
        Schema::create('filament_types_prices', function (Blueprint $table)
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('model_id');
            $table->smallInteger('filament_type_id');
            $table->decimal('price', 10, 2);

            // Indexes
            $table->unique(['model_id', 'filament_type_id']);

            // Foreign Keys
            $table->foreign('model_id')
                  ->references('id')->on('models')
                  ->cascadeOnDelete();
            $table->foreign('filament_type_id')
                  ->references('id')->on('filament_types')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filament_types_prices');
    }
};
