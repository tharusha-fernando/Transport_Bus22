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
        Schema::create('table_bus_doc', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('bus_id')->constrained();
            $table->foreignUuid('doc_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_buses_docs');
    }
};
