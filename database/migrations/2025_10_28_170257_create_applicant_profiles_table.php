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
        Schema::create('applicant_profiles', function (Blueprint $table) {
            $table->id(); // Kolom ID untuk profil
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Kunci asing ke tabel users
            $table->string('nomor_ktp', 16)->unique()->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('nomor_telepon', 15)->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('path_cv')->nullable(); // Untuk menyimpan path file CV
            $table->string('path_foto')->nullable(); // Untuk menyimpan path file foto profil
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_profiles');
    }
};
