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
        // Schema::create('tahaps', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });

        Schema::create('tahaps', function (Blueprint $table) { 
            $table->id();
            $table->foreignId('proyek_id')->constrained( 'proyeks', indexName: 'fk_tahaps_proyeks'); // Foreign key to proyeks table 
            $table->string('namaTahap'); 
            $table->string('statusTahap')->default('non-approval'); // Default status is 'non-active' $table->timestamps(); 
            $table->softDeletes(); // Soft delete column
            $table->timestamps(); // Timestamps for created_at and updated_at
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahaps');
    }
};
