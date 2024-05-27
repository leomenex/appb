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
        Schema::create('event_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id');
            $table->datetime('start');
            $table->datetime('end');
            $table->unsignedInteger('vacancy_limit');
            $table->unsignedInteger('vacancy_current')->default(0);
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_hours');
    }
};
