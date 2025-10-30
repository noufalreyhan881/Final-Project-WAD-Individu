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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_vacancy_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'reviewed', 'rejected', 'hired'])->default('pending');
            $table->timestamps();

            // Mencegah user yang sama melamar ke lowongan yang sama lebih dari sekali
            $table->unique(['user_id', 'job_vacancy_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
