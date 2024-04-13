<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ordered_models', function (Blueprint $table)
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('order_id');

            $table->integer('model_id');
            $table->smallInteger('model_size_id');
            $table->smallInteger('printing_technology_id');
            $table->smallInteger('filament_type_id');
            $table->smallInteger('color_id');
            $table->boolean('is_parted');
            $table->boolean('is_holed');

            $table->foreign('order_id')
                  ->references('id')->on('orders')
                  ->onDelete('cascade');
            $table->foreign('model_id')
                  ->references('id')->on('models')
                  ->onDelete('restrict');
            $table->foreign('model_size_id')
                  ->references('id')->on('models_sizes')
                  ->onDelete('restrict');
            $table->foreign('printing_technology_id')
                  ->references('id')->on('printing_technologies')
                  ->onDelete('restrict');
            $table->foreign('filament_type_id')
                  ->references('id')->on('filament_types')
                  ->onDelete('restrict');
            $table->foreign('color_id')
                  ->references('id')->on('colors')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordered_models');
    }
};
