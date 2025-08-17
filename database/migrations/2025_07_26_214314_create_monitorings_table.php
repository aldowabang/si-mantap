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
        Schema::create('monitorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyek_id')->constrained(
                'proyeks',
                indexName: 'fk_monitorings_proyeks'
            )->onDelete('cascade');
            $table->foreignId('tahap_id')->constrained(
                'tahaps',
                indexName: 'fk_monitoringtahaps_tahaps'
            )->onDelete('cascade'); // Ensure cascading delete
            $table->string('nama_monitoring');
            $table->string('deskripsi_monitoring')->nullable();
            $table->date('tanggal_monitoring')->nullable();
            $table->enum('status_monitoring', ['non-approval', 'approval-pengawas', 'approval-dinas'])->default('non-approval'); // Default status is 'non-active'
            $table->timestamps();
            $table->softDeletes(); // Soft delete column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitorings');
    }
};
