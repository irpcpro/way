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
        Schema::create('attachment_message', function (Blueprint $table) {
            $table->id('id_attachment_message');
            $table->unsignedBigInteger('id_attachment');
            $table->unsignedBigInteger('id_message');

            $table->foreign('id_attachment')->references('id_attachment')->on('attachments');
            $table->foreign('id_message')->references('id_message')->on('messages');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachment_message');
    }
};
