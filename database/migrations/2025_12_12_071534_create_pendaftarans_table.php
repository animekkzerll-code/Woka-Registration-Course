<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pendaftaran', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->enum('pendidikan', ['SMK','SMA','Mahasiswa','Lainnya']);
        $table->string('sekolah_univ');
        $table->string('jurusan_program');
        $table->string('kelas_tingkat');
        $table->string('nim_nisn');
        $table->string('phone');
        $table->foreignId('paket_id')->constrained('pricelist')->onDelete('cascade');
        $table->string('cv_link')->nullable();
        $table->enum('status', ['pending','approved','rejected'])->default('pending');
        $table->text('keterangan')->nullable(); 
        $table->date('tanggal_daftar')->default(now());

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
