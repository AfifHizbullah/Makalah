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
        Schema::create('posters', function (Blueprint $table) {
            $table->id();
            $table->string('Judul_Artikel');
            $table->string('Penulis');
            $table->string('Nama_Seminar');
            $table->string('Penyelenggara_Seminar');
            $table->date('Waktu_Pelaksaaan');
            $table->string('ISBN_ISSN');
            $table->string('URL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posters');
    }
};
