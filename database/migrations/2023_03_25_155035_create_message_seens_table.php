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
        Schema::create('message_seens', function (Blueprint $table) {
            $table->id('id_message_seen');
            $table->unsignedBigInteger('id_message');
            $table->unsignedBigInteger('id_user');
            $table->unique(['id_message', 'id_user']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_seens');
    }
};
