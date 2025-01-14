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
        Schema::create('portofolio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('sekuritas_id');
            $table->string('kode_saham', length: 4);
            $table->integer('jumlah_lot');
            $table->decimal('avg_price');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('sekuritas_id')->references('id')->on('sekuritas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolio');
    }
};
