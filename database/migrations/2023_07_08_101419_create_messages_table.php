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
            $table->uuid('id')->primary();
            $table->longText('message');
            //$table->unsignedBigInteger('thread_id');
            $table->string('status')->default('sent');
            $table->string('attachment')->nullable();
            $table->timestamp('read_at')->nullable();
            //$table->unsignedBigInteger('user_id');
            $table->foreignUuid('user_id')->constrained();
            $table->foreignUuid('thread_id')->constrained();
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
