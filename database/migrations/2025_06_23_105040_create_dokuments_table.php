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
        Schema::create('dokuments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('monitoring_id')->constrained(
                'monitorings',
                indexName: 'fk_dokuments_monitorings' // Optional: specify index name
            );
            // Ensure cascading delete
            $table->foreignId('tahap_id')->constrained(
                'tahaps',
                indexName: 'fk_dokuments_tahaps' // Optional: specify index name
            )->onDelete('cascade');
            $table->string('namaDokumen');
            $table->string('file_path_dokument')->nullable();
            $table->string('deskripsi_dokument')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokuments');
    }
};
