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
        Schema::create('productlines', function (Blueprint $table) {
            $table->timestamps();
            $table->string( 'productLine', 50)->primary();
            $table->string( 'textDescription', 4000)->nullable(true);
            $table->text( 'htmlDescription')->nullable(true);
            $table->binary('image')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productlines');
    }
};
