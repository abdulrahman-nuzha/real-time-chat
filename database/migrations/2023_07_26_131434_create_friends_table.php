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
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id_1");
            $table
                ->foreign("user_id_1")
                ->references("id")
                ->on("users");
            $table->unsignedBigInteger("user_id_2");
            $table
                ->foreign("user_id_2")
                ->references("id")
                ->on("users");

            $table->unique(['user_id_1', 'user_id_2']);
                    
            $table->enum("status", ["approved", "pending", "rejected"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friends');
    }
};
