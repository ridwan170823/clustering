<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('students', function (Blueprint $t) {
      $t->id();
      $t->string('nama');
      $t->string('nim')->unique();
      // simpan jawaban mentah (string) agar mudah diaudit
      $t->string('pendapatan');
      $t->string('pekerjaan_ortu');
      $t->string('tanggungan');
      $t->string('kepemilikan_rumah');
      $t->string('status_ortu');
      $t->timestamps();
    });
  }
  public function down(): void { Schema::dropIfExists('students'); }
};
