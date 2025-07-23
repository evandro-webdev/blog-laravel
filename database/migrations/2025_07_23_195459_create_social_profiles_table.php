<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up()
  {
    Schema::create('social_profiles', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained()->cascadeOnDelete();
      $table->enum('provider', ['twitter', 'facebook', 'instagram', 'linkedin', 'website', 'github', 'youtube']);
      $table->string('url');
      $table->timestamps();
      $table->unique(['user_id', 'provider']);
    });
  }

  public function down()
  {
    Schema::dropIfExists('social_profiles');
  }
};