<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::table('activity_logs', function (Blueprint $table) {
      $table->text('description')->nullable()->change();
      $table->unsignedBigInteger('subject_id')->nullable()->change();
      $table->string('subject_id')->nullable()->change();
    });
  }

  public function down(): void
  {
    Schema::table('activity_logs', function (Blueprint $table) {
      $table->text('description')->nullable(false)->change();
      $table->unsignedBigInteger('subject_id')->nullable(false)->change();
      $table->string('subject_id')->nullable(false)->change();
    });
  }
};
