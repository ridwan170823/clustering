<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void {
    Schema::create('ukt_predictions', function (Blueprint $t) {
      $t->id();
      $t->foreignId('student_id')->constrained()->cascadeOnDelete();
      $t->unsignedInteger('cluster');
      $t->string('tier'); // "UKT 1" .. "UKT 5"
      $t->json('vector')->nullable(); // fitur terstandarisasi (opsional)
      $t->timestamps();
    });
  }
  public function down(): void { Schema::dropIfExists('ukt_predictions'); }
};
