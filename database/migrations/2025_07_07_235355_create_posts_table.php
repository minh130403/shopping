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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('slug');
            $table->foreignId('avatar_id')->nullable()->constrained('photos', 'id')->nullOnDelete();
            $table->softDeletes();
            // $table->enum('status', ['new', 'old', 'out_of_stock', 'coming_soon'])->default('new');
            $table->enum('state', ['hidden', 'draft', 'published'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
