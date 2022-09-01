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
        Schema::create('add_praking_desc', function (Blueprint $table) {
            $table->id();
           
            $table->bigInteger('is_two_hrs');
            $table->bigInteger('is_four_hrs');
            $table->bigInteger('is_eight_hrs');
            $table->bigInteger('more');
            $table->bigInteger('is_rent');
            $table->float('is_two_hrs_amt');
            $table->float('is_four_hrs_amt');
            $table->float('is_eight_hrs_amt');
            $table->float('more_amt');
            $table->bigInteger('is_rent_amt');
            $table->bigInteger('add_praking_slot_id');





         
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
