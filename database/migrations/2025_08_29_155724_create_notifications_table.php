<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::create('notifications', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
      $table->foreignIdFor(User::class, 'actor_id')->nullable()->constrained('users')->nullOnDelete();
      $table->enum('type', [
        'follow',
        'comment',
        'post_published',
        'post_saved'
      ]);
      $table->morphs('notifiable');
      $table->json('data')->nullable();
      $table->timestamps();

      $table->index(['user_id', 'created_at']);
      $table->index(['type']);
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('notifications');
  }
};
