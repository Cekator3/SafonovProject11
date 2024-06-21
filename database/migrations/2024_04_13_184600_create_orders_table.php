<?php

use App\Enums\OrderStatus;
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
        Schema::create('orders', function (Blueprint $table)
        {
            $table->integer('id')->generatedAs()->always()->primary();
            $table->integer('customer_id');
            $table->enum('status', OrderStatus::GetAllValues());
            $table->timestamp('payed_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->foreign('customer_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
