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
        Schema::create('proyeks', function (Blueprint $table) {
            $table->id();
            $table->foreignid('user_id')->constrained(
                'users',
                indexName: 'fk_proyeks_users' // Optional: specify index name
            );
            $table->string('nameProyek');
            $table->string('lokasi');
            $table->string('jenis');
            $table->string('nilai');
            $table->string('gambar')->nullable();
            $table->string('file_path')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('status')->default('non-active');
            $table->timestamps();
            $table->softDeletes(); // Soft delete column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyeks');
    }
};
