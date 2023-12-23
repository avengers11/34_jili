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
        Schema::create('jili_managements', function (Blueprint $table) {
            $table->id();
            $table->integer('run')->default(0);
            $table->string('nextwin', 50)->nullable();
            $table->integer('x5')->default(0);
            $table->integer('min')->default(0);
            $table->integer('mid')->default(0);
            $table->integer('max')->default(0);
            $table->integer('st')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jili_managements');
    }
};
