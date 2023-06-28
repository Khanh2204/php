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
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedInteger('orderNumber');
            $table->string('productCode',15);
            $table->unsignedInteger('quantityOrdered');
            $table->unsignedDecimal('priceEach',10,2);
            $table->unsignedInteger('orderLineNumber');
            
            $table->foreign('orderNumber')->references('orderNumber')->on('orders');
            $table->foreign('productCode')->references('productCode')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orderdetails');
    }
};
