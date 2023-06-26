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
        Schema::create('user_dialogues', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('dialogue_id');
            $table->unsignedBigInteger('user_id');

            $table->index('dialogue_id', 'dialogue_user_dialogue_idx');
            $table->index('user_id', 'dialogue_user_user_idx');

            $table->foreign('dialogue_id', 'dialogue_user_dialogue_fk')->on('dialogues')->references('id');
            $table->foreign('user_id', 'dialogue_user_user_fk')->on('users')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_dialogues');
    }
};
