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
            $table->softDeletes();
            // $table->enum('status', ['new', 'old', 'out_of_stock', 'coming_soon'])->default('new');
            $table->enum('state', ['hidden', 'draft', 'published'])->default('draft');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn("state");
            $table->dropSoftDeletes();
        });
    }
};
