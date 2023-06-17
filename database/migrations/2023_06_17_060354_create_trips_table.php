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
        Schema::create('trips', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('time_table_id')->constrained();
            $table->foreignUuid('bus_id')->constrained();
            $table->string('type');
            $table->string('details')->nullable();
            $table->foreignUuid('location_id')->nullable()->constrained();
            $table->time('start');
            $table->time('end');
            $table->foreignUuid('route_id')->constrained();
            $table->float('distance');
            $table->string('status')->default('scheduled');
            $table->foreignUuid('from')->constrained('bus_stations');
            $table->foreignUuid('to')->constrained('bus_stations');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
