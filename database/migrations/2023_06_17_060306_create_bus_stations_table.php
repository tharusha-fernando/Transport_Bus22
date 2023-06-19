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
        Schema::create('bus_stations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('address');
            $table->string('slug')->unique();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->foreignUuid('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_stations');
    }
};
