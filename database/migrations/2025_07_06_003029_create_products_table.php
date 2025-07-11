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
            $table->string('id')->primary();
            $table->string("name");
            $table->integer("price")->nullable();
            $table->text("short_description")->nullable();
            $table->text("description")->nullable();
            $table->string("slug")->unique();
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
