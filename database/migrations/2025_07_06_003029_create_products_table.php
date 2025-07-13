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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("price")->nullable();
            $table->text("short_description")->nullable();
            $table->text("description")->nullable();
            $table->string("slug")->unique();
             $table->softDeletes();
             $table->enum('status', ['new', 'old', 'out_of_stock', 'coming_soon'])->default('new');
            $table->enum('state', ['hidden', 'draft', 'published'])->default('draft');
            $table->foreignId("avatar_id")->nullable()->constrained('photos', 'id')->nullOnDelete();
            $table->foreignId("category_id")->nullable()->constrained("categories", "id")->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
