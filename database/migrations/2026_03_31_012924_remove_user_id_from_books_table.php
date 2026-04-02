<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
      Schema::table('books', function (Blueprint $table) {
        // 🔥 Step 1: Drop foreign key
        $table->dropForeign(['user_id']);

        // 🔥 Step 2: Drop column
        $table->dropColumn('user_id');
    });
}


public function down()
{
    Schema::table('books', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id');
    });
}
};
