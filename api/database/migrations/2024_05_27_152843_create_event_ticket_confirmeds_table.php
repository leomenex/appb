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
        Schema::create('event_ticket_confirmeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id');
            $table->datetime('check_in')->nullable();
            $table->datetime('check_out')->nullable();
            $table->timestamps();

            $table->foreign('reservation_id')->references('id')->on('event_ticket_reservations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_ticket_confirmeds');
    }
};
