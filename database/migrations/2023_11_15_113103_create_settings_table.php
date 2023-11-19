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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')
                ->references('id')->on('settings_groups')
                ->onDelete('cascade');
            $table->string('code', 50);
            $table->string('name', 255);
            $table->text('description')->nullable()->default(null);
            $table->text('params')->nullable()->default(null);
            $table->text('value')->nullable()->default(null);
            $table->unsignedTinyInteger('type')->nullable()->default(0);
            $table->unsignedTinyInteger('order')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
