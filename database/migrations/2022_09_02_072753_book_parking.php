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
        Schema::create('book_parking', function (Blueprint $table) {
            $table->id(); 
            $table->bigInteger('paking_type');
            $table->bigInteger('parking_amt');
            $table->bigInteger('user_id');
            $table->bigInteger('address_id');
            $table->bigInteger('payment_status');
            $table->bigInteger('parking_status');
            $table->bigInteger('payment_id');
            $table->bigInteger('parking_slot_number');
            $table->integer('is_cacnceled');
            $table->timestamp('start_date');
            $table->timestamp('end_date');
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
