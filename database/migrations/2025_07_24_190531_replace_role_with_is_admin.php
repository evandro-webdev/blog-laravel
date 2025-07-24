<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
  public function up()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->boolean('is_admin')->default(false)->after('password');
    });

    DB::table('users')->where('role', 'admin')->update(['is_admin' => true]);

    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn('role');
    });
  }

  public function down()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->string('role')->default('user');
    });

    DB::table('users')->where('is_admin', true)->update(['role' => 'admin']);

    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn('is_admin');
    });
  }
};