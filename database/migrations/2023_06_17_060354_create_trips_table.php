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
            $table->id();
            $table->foreignId('timetable_id')->constrained();
            $table->foreignId('bus_id')->constrained();
            $table->string('type');
            $table->string('details')->nullable();
            $table->foreignId('location_id')->nullable()->constrained();
            $table->time('start');
            $table->time('end');
            $table->foreignId('route_id')->constrained();
            $table->float('distance');
            $table->string('status')->default('pending');
            $table->foreignId('from')->constrained('stations');
            $table->foreignId('to')->constrained('stations');
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
