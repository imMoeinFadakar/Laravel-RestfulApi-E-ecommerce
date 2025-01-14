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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained();

            $table->tinyInteger('status');

            $table->unsignedBigInteger( 'total_amount');

            $table->unsignedBigInteger('delivery_amount');

            $table->unsignedBigInteger('paying_amount');

            $table->unsignedBigInteger('paying_status');

            $table->softDeletes();

            $table->timestamps();
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
