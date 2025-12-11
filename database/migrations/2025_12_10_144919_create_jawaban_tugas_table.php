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
        Schema::create('jawaban_tugas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tugas');
            $table->string('nim');
            $table->text('deskripsi')->nullable();
            $table->string('jawaban_tugas');
            $table->enum('status', ['submitted', 'graded'])->default('submitted');
            $table->integer('nilai')->nullable(); // opsional: nilai dari dosen

            $table->timestamps();
            $table->foreign('kode_tugas')->references('kode_tugas')->on('tugas')->onDelete('cascade');
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_tugas');
    }
};
