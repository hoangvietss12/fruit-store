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
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('vendor_id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->json('images')->nullable();
            $table->string('unit')->nullable();
            $table->float('quantity')->nullable();
            $table->integer('price')->nullable();
            $table->float('discount')->nullable();
            $table->string('status')->nullable()->default('Còn hàng');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('vendor_id')->references('id')->on('vendors');
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
