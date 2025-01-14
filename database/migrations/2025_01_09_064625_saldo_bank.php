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
        Schema::create('SaldoBank', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bank_id');
            $table->decimal('nominal');
            $table->string('rekening');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('bank_id')->references('id')->on('NamaBank');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('SaldoBank');
    }
};
