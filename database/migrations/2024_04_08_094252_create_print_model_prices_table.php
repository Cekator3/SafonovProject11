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
        Schema::create('print_model_prices', function (Blueprint $table)
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('model_id');
            $table->smallInteger('printing_technology_id');
            $table->smallInteger('filament_type_id');
            $table->smallInteger('color_id');
            $table->integer('model_size_id');
            $table->boolean('is_holed');
            $table->boolean('is_parted');
            $table->decimal('price', 10, 2);

            $table->unique(['model_id', 'printing_technology_id', 'filament_type_id', 'color_id', 'model_size_id', 'is_holed', 'is_parted']);
            $table->foreign('model_id')
                  ->references('id')->on('models')
                  ->onDelete('cascade');
            $table->foreign('printing_technology_id')
                  ->references('id')->on('printing_technologies')
                  ->onDelete('cascade');
            $table->foreign('filament_type_id')
                  ->references('id')->on('filament_types')
                  ->onDelete('cascade');
            $table->foreign('color_id')
                  ->references('id')->on('colors')
                  ->onDelete('restrict');
            $table->foreign('model_size_id')
                  ->references('id')->on('models_sizes')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('print_model_prices');
    }
};
