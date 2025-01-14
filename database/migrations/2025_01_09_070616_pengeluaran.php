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
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('jenis_pengeluaran', ['Makanan', 'Hiburan', 'Barang Elektronik', 'Skin/Haircare', 'Fashion', 'Misc', 'Hadiah', 'Transportasi', 'Edukasi', 'Amal', 'Kesehatan', 'Akomodasi', 'Investasi']);
            $table->enum('status', ['Harus Punya', 'Penting', 'Gak Punya Gapapa', 'Self-Reward']);
            $table->date('tanggal_pengeluaran');
            $table->decimal('nominal');
            $table->enum('sumber_dana', ['Tunai', 'Rekening']);
            $table->unsignedBigInteger('rekening_bank')->nullable();
            $table->string('keterangan');
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
        Schema::dropIfExists('pengeluaran');
    }
};
