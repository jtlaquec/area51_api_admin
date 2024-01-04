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
            $table->string('sku');
            $table->string('brand')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->json('product_details')->nullable();
            $table->string('image_path')->nullable();
            $table->float('price');

            $table->foreignId('subcategory_id')
            ->constrained();
            $table->decimal('percentage_discount', 5, 2)->nullable();
            $table->boolean('has_discount')->default(false);
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
