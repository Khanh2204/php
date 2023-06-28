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
        Schema::create('customers', function (Blueprint $table) {
            $table->timestamps();

            $table->increments('customerNumber', 10);
            $table->string('customerName',50);
            $table->string('contactLastName',50);
            $table->string('contactFirstName',50);
            $table->string('phone',50);
            $table->string('addressLine1',50);
            $table->string('addressLine2',50)->nullable(true);
            $table->string('city',50);
            $table->string('state',50)->nullable(true);
            $table->string('postalCode',15)->nullable(true);
            $table->string('country',50);
            $table->unsignedInteger('salesRepEmployeeNumber')->nullable(true);
            $table->unsignedDecimal('creditLimit',50)->nullable(true);
            
            $table->foreign('salesRepEmployeeNumber')->references('employeeNumber')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

