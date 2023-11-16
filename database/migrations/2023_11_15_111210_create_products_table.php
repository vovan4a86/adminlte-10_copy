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
            $table->unsignedBigInteger('catalog_id');
            $table->foreign('catalog_id')
                ->references('id')->on('catalogs')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('h1')->nullable()->default(null);
            $table->string('alias');
            $table->text('announce')->nullable()->default(null);
            $table->text('text')->nullable()->default(null);
            $table->decimal('price')->nullable()->default(0);
            $table->decimal('old_price')->nullable()->default(0);
            $table->string('title')->nullable()->default(null);
            $table->string('keywords')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->string('og_title')->nullable()->default(null);
            $table->string('og_description')->nullable()->default(null);
            $table->unsignedTinyInteger('order')->nullable()->default(0);
            $table->boolean('published')->default(true);
            $table->boolean('in_stock')->default(true);
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
