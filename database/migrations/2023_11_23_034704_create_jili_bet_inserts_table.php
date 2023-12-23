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
        Schema::create('jili_bet_inserts', function (Blueprint $table) {
            $table->id();
            $table->integer('board_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->integer('amount')->default(0);
            $table->string('winner', 50)->nullable();
            $table->integer('st')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jili_bet_inserts');
    }
};
