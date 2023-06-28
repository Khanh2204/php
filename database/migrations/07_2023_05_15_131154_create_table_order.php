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
            $table->timestamps();

            $table->increments('orderNumber');
            $table->date('orderDate');
            $table->date('requiredDate');
            $table->date('shippedDate')->nullable(true);
            $table->string('status',15);
            $table->text('comments')->nullable(true);
            $table->unsignedInteger('customerNumber');

            $table->foreign('customerNumber')->references('customerNumber')->on('customers');
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

