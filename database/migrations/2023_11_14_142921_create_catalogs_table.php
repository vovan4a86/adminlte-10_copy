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
        Schema::create('catalogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('name');
            $table->string('h1')->nullable()->default(null);
            $table->string('alias');
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->text('text')->nullable()->default(null);
            $table->string('title')->nullable()->default(null);
            $table->string('keywords')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->string('og_title')->nullable()->default(null);
            $table->string('og_description')->nullable()->default(null);
            $table->text('product_title_template')->nullable()->default(null);
            $table->text('product_description_template')->nullable()->default(null);
            $table->text('product_text_template')->nullable()->default(null);
            $table->unsignedTinyInteger('order')->nullable()->default(0);
            $table->boolean('published')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogs');
    }
};
