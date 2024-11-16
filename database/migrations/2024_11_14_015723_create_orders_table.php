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
            $table->id(); // Ensure the primary key is 'id'
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('order_date')->useCurrent();
            $table->timestamp('estimated_arrival')->useCurrent();
            $table->enum('status', ['Pending', 'Shipped', 'Delivered', 'Cancelled']);
            $table->string('type');
            $table->string('buy_method');
            $table->decimal('total_amount', 10, 2);
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
