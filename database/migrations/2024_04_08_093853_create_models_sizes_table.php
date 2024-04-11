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
        Schema::create('models_sizes', function (Blueprint $table)
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('model_id');
            $table->double('size_multiplier');
            $table->integer('length');
            $table->integer('width');
            $table->integer('height');

            $table->unique(['model_id', 'size_multiplier']);
            $table->unique(['model_id', 'length', 'width', 'height']);
            $table->foreign('model_id')
                  ->references('id')->on('models')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('models_sizes');
    }
};
