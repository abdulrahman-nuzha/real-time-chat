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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string("message");
            $table->enum('type', ['text', 'image', 'voice', 'video']);

            $table->unsignedBigInteger("room_id");
            $table
                ->foreign("room_id")
                ->references("id")
                ->on("rooms");

            $table->unsignedBigInteger("sender_id");
            $table
                ->foreign("sender_id")
                ->references("id")
                ->on("users");

            $table->unsignedBigInteger("receiver_id");
            $table
                ->foreign("receiver_id")
                ->references("id")
                ->on("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
