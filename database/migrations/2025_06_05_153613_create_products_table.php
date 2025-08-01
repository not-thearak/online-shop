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
            $table->string('name');
            $table->foreignId('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->text('desc')->nullable();
            $table->float('price');
            $table->integer('qty');
            $table->foreignId('brand_id')->references('id')->on('brands')->cascadeOnDelete();
            $table->string('color');
            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->enum('status',[1,0])->default(1);
            $table->timestamps();
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
