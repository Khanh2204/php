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
            $table->timestamps();
            $table->string('productCode', 15)->primary();
            $table->string('productName', 70);
            $table->string('productLine', 50);
            $table->string('productScale', 10);
            $table->string('productVendor', 50);
            $table->text('productDescription');
            $table->integer('quantityInStock');
            $table->unsignedDecimal('buyPrice', 10,2);
            $table->unsignedDecimal('MSRP', 10,2);
            
            $table->foreign('productLine')->references('productLine')->on('productLines');
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
