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
        Schema::create('pemasukan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('sumber_pemasukan', ['Gaji', 'Bonus', 'Hadiah', 'Investasi']);
            $table->enum('kategori', ['Passive', 'Active']);
            $table->string('keterangan');
            $table->enum('deposit_method', ['Tunai', 'Rekening']);
            $table->unsignedBigInteger('rekening_bank')->nullable();
            $table->date('tanggal_pemasukan');
            $table->decimal('nominal');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('rekening_bank')->references('id')->on('SaldoBank');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukan');
    }
};
