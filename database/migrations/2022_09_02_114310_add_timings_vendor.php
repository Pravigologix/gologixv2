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
        Schema::create('parking_charges', function (Blueprint $table) {
            $table->id(); 
            $table->bigInteger('vendor_id');
            $table->float('parking_amt');
            $table->bigInteger('add_praking_desc_id');
            $table->bigInteger('add_praking_slot_id');
            $table->integer('is_active');
            $table->integer('is_delete');
            $table->integer('address_id');

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
        Schema::drop('book_parking');
        
    }
};
