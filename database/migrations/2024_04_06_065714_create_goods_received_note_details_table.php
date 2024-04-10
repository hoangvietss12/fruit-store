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
        Schema::create('goods_received_note_details', function (Blueprint $table) {
            $table->unsignedBigInteger('goods_received_note_id');
            $table->unsignedBigInteger('product_id');
            $table->float('quantity');
            $table->integer('price');
            $table->decimal('total_price', 10, 2);
            $table->string('note')->nullable();
            $table->timestamps();

            $table->foreign('goods_received_note_id')->references('id')->on('goods_received_note')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_received_note_details');
    }
};
