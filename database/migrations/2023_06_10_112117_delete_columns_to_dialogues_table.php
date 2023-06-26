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
        Schema::table('dialogues', function (Blueprint $table) {
            $table->dropColumn('login_1');
            $table->dropColumn('login_2');
            $table->dropColumn('name_1');
            $table->dropColumn('name_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dialogues', function (Blueprint $table) {
            //
        });
    }
};
