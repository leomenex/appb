<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!App::runningUnitTests()) {
            DB::statement("
                CREATE SEQUENCE IF NOT EXISTS global_id_sequence;
            ");

            DB::statement("
                CREATE OR REPLACE FUNCTION id_generator(OUT result bigint) AS $$
                DECLARE
                    our_epoch bigint := 1314220021721;
                    seq_id bigint;
                    now_millis bigint;
                    -- the id of this DB shard, must be set for each
                    -- schema shard you have - you could pass this as a parameter too
                    shard_id int := 1;
                BEGIN
                    SELECT nextval('global_id_sequence') % 1024 INTO seq_id;

                    SELECT FLOOR(EXTRACT(EPOCH FROM clock_timestamp()) * 1000) INTO now_millis;
                    result := (now_millis - our_epoch) << 23;
                    result := result | (shard_id << 10);
                    result := result | (seq_id);
                END;
                $$ LANGUAGE PLPGSQL;
            ");
        }

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->date('date');
            $table->boolean('is_draft')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
