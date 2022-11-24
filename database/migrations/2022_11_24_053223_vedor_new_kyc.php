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
        Schema::create('vendor_new_kyc', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('addhar_number');
            $table->string('doc1');
            $table->string('doc2');
            $table->integer('status');


           


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
        Schema::dropIfExists('vendor_new_kyc');
        
    }
};
