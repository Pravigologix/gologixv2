<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_praking_slot', function (Blueprint $table) {
            $table->id();
            $table->integer('parking_type');
            $table->integer('parking_no');
            $table->time('starts_at', $precision = 0);
            $table->time('ends_at', $precision = 0);
            $table->integer('parking_slots');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('add_praking_slot');
    }
};
