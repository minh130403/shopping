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
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId("order_id")->constrained("orders", "id")->cascadeOnDelete();
            $table->foreignId("product_id")->constrained("products", "id")->cascadeOnDelete();
            $table->string("product_name");
            $table->integer("amount");
            $table->integer("price")->nullable();
            $table->bigInteger("total_price")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_detail');
    }
};
