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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained();
            $table->foreignId('district_id')->constrained();
            $table->decimal('cost', 8, 2);
            $table->date('estimated_delivery_date')->nullable()->default(NULL);;
            $table->string('shipping_number')->nullable()->default(NULL);;
            $table->string('shipping_code')->nullable()->default(NULL);;
            $table->string('notes')->nullable()->default(NULL);;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
