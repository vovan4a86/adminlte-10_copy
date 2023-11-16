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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('alias');
            $table->date('date');
            $table->string('announce')->nullable()->default(null);
            $table->text('text')->nullable()->default(null);
            $table->string('image')->nullable()->default(null);
            $table->string('title')->nullable()->default(null);
            $table->string('keywords')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->string('og_title')->nullable()->default(null);
            $table->string('og_description')->nullable()->default(null);
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
        Schema::dropIfExists('news');
    }
};
