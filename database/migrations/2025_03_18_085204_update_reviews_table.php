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
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('product_id')->unique();
            $table->text('content');
            $table->unsignedTinyInteger('rating')->default(5);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('product_id');
            $table->dropColumn('content');
            $table->dropColumn('rating');
        });
    }
};
