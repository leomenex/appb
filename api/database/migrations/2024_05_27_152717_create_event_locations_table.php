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
        Schema::create('event_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('cep');
            $table->string('address');
            $table->string('number');
            $table->string('neighborhood')->comment('bairro');
            $table->string('country')->nullable()->default('BR');
            $table->string('state')->nullable()->default('RR');
            $table->string('city')->nullable()->default('Boa Vista');
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_locations');
    }
};
