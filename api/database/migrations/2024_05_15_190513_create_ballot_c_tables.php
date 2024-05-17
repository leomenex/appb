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
        // tabela de fonte pagadora
        Schema::create('ballot_c_configs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('font');
            $table->string('doc');
            $table->string('email')->nullable();
            $table->unsignedInteger('reference_year');
            $table->timestamps();
        });

        // font pagadora
        Schema::create('ballot_c_infos', function (Blueprint $table) {
            $table->id();
            $table->string('cpf');
            $table->string('text');
            $table->unsignedInteger('reference_year');
            $table->timestamps();
        });

        // beneficiarios
        Schema::create('ballot_c_servers', function (Blueprint $table) {
            $table->id();
            $table->string('cpf');
            $table->string('name');
            $table->string('idrec')->nullable();
            $table->unsignedInteger('reference_year');
            $table->timestamps();
        });

        // valores do beneficiario
        Schema::create('ballot_c_values', function (Blueprint $table) {
            $table->id();
            $table->string('cpf');
            $table->string('name');
            $table->double('value');
            $table->unsignedInteger('month');
            $table->unsignedInteger('reference_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ballot_c_configs');
        Schema::dropIfExists('ballot_c_infos');
        Schema::dropIfExists('ballot_c_servers');
        Schema::dropIfExists('ballot_c_values');
    }
};
