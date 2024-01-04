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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->datetime('datetime');
            $table->decimal('total', 8, 2);
            $table->text('reason');
            $table->text('shipping_address');
            $table->foreignId('state_id')->constrained();
            $table->foreignId('user_id')->constrained();
/*             $table->foreignId('receipt_id')->constrained()->nullable()->default(NULL);
            $table->foreignId('comment_id')->constrained()->nullable()->default(NULL); */
            /* $table->foreignId('payment_id')->constrained()->nullable()->default(NULL); */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
