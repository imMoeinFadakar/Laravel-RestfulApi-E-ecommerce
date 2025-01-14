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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained();

            $table->foreignId('order_id')->constrained();

            $table->unsignedBigInteger('amount');

            $table->string('token')->nullable();

            $table->string('trans_id')->nullable();

            $table->tinyInteger('status')->default(0);

            $table->string('request_from')->default('web');

            $table->softDeletes();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
