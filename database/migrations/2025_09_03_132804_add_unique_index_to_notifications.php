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
      Schema::table('notifications', function (Blueprint $table) {
        $table->unique(
          ['user_id', 'notifiable_id', 'notifiable_type', 'type'],
          'notifications_user_notifiable_type_unique'
        );
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('notifications', function (Blueprint $table) {
        $table->dropUnique('notifications_user_notifiable_type_unique');
      });
    }
};
