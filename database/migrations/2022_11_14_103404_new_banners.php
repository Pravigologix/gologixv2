<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
       public function up()
    {
        Schema::create('new_banner', function (Blueprint $table) {
            $table->id();
            $table->integer('banner_image_url');
            $table->integer('banner_descprition');
           


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
        Schema::drop('new_banner');
    }
};
