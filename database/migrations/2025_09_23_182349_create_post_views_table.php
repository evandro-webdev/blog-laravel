<?php

use App\Models\Post;
use App\Models\User;
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
    Schema::create('post_views', function (Blueprint $table) {
      $table->id();
      $table->foreignIdFor(Post::class)->constrained()->cascadeOnDelete();
      $table->foreignIdFor(User::class)->constrained()->onDelete('set null');
      $table->ipAddress();
      $table->timestamp('viewed_at');
      $table->timestamps();

      $table->index(['post_id', 'viewed_at']);
      $table->index(['user_id', 'viewed_at']);

      $table->unique(['post_id', 'ip_address', 'viewed_at']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('post_views');
  }
};
