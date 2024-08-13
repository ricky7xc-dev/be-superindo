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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('plu');
            $table->string('name');
            $table->integer('product_category_id');
            $table->boolean('active')->default(true);
            $table->string('created_user')->nullable();
            $table->timestamp('created_date')->useCurrent();
            $table->string('updated_user')->nullable();
            $table->timestamp('updated_date')->nullable();
        });

        Schema::create('product_variant', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('code');
            $table->string('name');
            $table->string('image_location');
            $table->integer('qty');
            $table->string('price');
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('product');
        Schema::dropIfExists('product_variant');
    }
};
