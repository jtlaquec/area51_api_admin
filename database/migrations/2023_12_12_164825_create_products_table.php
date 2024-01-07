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
            $table->string('brand')->nullable()->default(NULL);
            $table->string('name');
            $table->text('description')->nullable()->default(NULL);
            $table->json('product_details')->nullable()->default(NULL);
            $table->string('image_path')->nullable()->default(NULL);
            $table->decimal('price',8,2)->nullable()->default(NULL);

            $table->foreignId('subcategory_id')
            ->constrained();
            $table->integer('percentage_discount')->nullable()->default(NULL);
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
