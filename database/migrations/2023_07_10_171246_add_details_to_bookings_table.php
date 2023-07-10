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
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignUuid('start')->constrained('locations')->cascadeOnDelete();
            $table->foreignUuid('end')->constrained('locations')->cascadeOnDelete();
            $table->integer('amount');
            $table->string('seat_numbers');
            $table->integer('price');
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['start']);
            $table->dropForeign(['end']);
            $table->dropColumn(['end','start','amount', 'seat_numbers', 'price']);
            //
        });
    }
};
