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
        Schema::create('monitoringtahaps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('monitoring_id')->constrained(
                'monitorings',
                indexName: 'fk_monitoringtahaps_monitorings'
            )->onDelete('cascade'); // Ensure cascading delete
            $table->foreignId('tahap_id')->constrained(
                'tahaps',
                indexName: 'fk_monitoringtahaps_tahaps'
            )->onDelete('cascade'); // Ensure cascading delete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoringtahaps');
        
    }
};
