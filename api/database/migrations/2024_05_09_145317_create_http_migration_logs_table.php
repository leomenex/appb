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
        Schema::create('http_migration_logs', function (Blueprint $table) {
            $table->id();
            $table->string('class');
            $table->string('line');
            $table->string('url')->nullable();
            $table->string('status');
            $table->string('message')->nullable();
            $table->longText('trace')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('http_migration_logs');
    }
};
