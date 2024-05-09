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
            $table->bigInteger('external_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->longText('content');
            $table->string('slug');
            $table->boolean('show_in_slide')->default(true)->nullable();
            $table->string('path_image');
            $table->string('path_image_thumbnail');
            $table->boolean('is_published')->default(false)->nullable();
            $table->datetime('date_published');
            $table->datetime('start_time')->nullable();
            $table->datetime('end_time')->nullable();
            $table->datetime('external_created_at');
            $table->datetime('external_updated_at');
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
