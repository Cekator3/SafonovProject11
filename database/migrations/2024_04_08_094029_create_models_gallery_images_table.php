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
        Schema::create('models_gallery_images', function (Blueprint $table)
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('model_id');
            $table->text('image');

            $table->unique(['model_id', 'image']);
            $table->foreign('model_id')
                  ->references('id')->on('models')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('models_gallery_images');
    }
};
