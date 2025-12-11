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
        Schema::create('token_absen', function (Blueprint $table) {
            $table->id();
            $table->string('jadwal');
            $table->string('token')->unique();      // token unik untuk pertemuan
            $table->timestamp('valid_from');        // kapan token mulai berlaku
            $table->timestamp('valid_until');
            $table->string('kode_mk');
            $table->timestamps();
            $table->foreign('kode_mk')
                ->references('kode_mk')
                ->on('matakuliah')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_absens');
    }
};
