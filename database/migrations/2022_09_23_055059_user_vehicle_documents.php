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
        Schema::create('user_vehicle_documents', function(Blueprint $table) {
            $table->id();
            $table->integer('user_vehicle_id');
            $table->integer('user_id');
            $table->string('driving_licence_path');
            $table->string('registration_certificate_path');
            $table->string('aadhar_card_path');
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
        Schema::drop('user_vehicle_documents');
    }
};
