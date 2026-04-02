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
        
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['title', 'description']);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->text('description')->nullable();
        });
    }
};
