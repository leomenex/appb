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
        Schema::create('news_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('external_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('sort_order')->nullable();
            $table->string('color')->nullable();
            $table->string('text_color')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

        Schema::table('news', function (Blueprint $table) {
            $table->foreignId('category_id');

            $table->foreign('category_id')->references('id')->on('news')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_categories');
    }
};
