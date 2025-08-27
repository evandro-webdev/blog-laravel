<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::rename('post_user_reads', 'read_posts');
    }

    public function down(): void
    {
        Schema::rename('read_posts', 'post_user_reads');
    }
};
