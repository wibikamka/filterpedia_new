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
        Schema::table('posts', function (Blueprint $table) {
            // Tambah kolom category dengan nilai terbatas (enum)
            $table->enum('category', ['news', 'knowledge', 'lifestyle', 'product-info'])
                  ->nullable()
                  ->after('is_published');
            
            // Tambah kolom tags dengan tipe JSON
            $table->json('tags')
                  ->nullable()
                  ->after('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Hapus kolom jika rollback
            $table->dropColumn(['category', 'tags']);
        });
    }
};