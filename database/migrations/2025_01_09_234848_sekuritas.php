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
        Schema::create('sekuritas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('kode_sekuritas', length: 2);
            $table->string('logo_sekuritas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekuritas');
    }
};
