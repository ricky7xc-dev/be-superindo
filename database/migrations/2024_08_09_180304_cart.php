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
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('product_variant_id')->nullable();
            $table->integer('invoice_id')->nullable();
            $table->integer('qty')->nullable();
            $table->string('status')->nullable();
            $table->string('created_user')->nullable();
            $table->timestamp('created_date')->useCurrent();
            $table->string('updated_user')->nullable();
            $table->timestamp('updated_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
