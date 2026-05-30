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
        Schema::create('players', function (Blueprint $table) {

            $table->id();

            $table->string('name');
            $table->string('country', 3);

            $table->unsignedInteger('ranking');
            $table->unsignedInteger('seed')->nullable();

            $table->unsignedInteger('age');

            $table->enum('handedness', ['right', 'left'])->default('right');

            $table->string('img_url')->nullable();
            $table->boolean('active')->default(true);

            $table->timestamps();

            $table->index('ranking');
            $table->index('seed');
            $table->index('active');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
