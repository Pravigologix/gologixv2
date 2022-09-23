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
        Schema::create('wallet_parking', function (Blueprint $table) {
        $table->id();
        $table->integer('wal_user_id');
        $table->bigInteger('wal_balance')->default(0);
        $table->string('wal_transaction_id');
        $table->bigInteger('credited_amt')->default(0);
        $table->bigInteger('debited_amt')->default(0);
        $table->integer('wal_isactive')->set(1);
        $table->integer('wal_isdeleted')->set(0);
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
        Schema::dropIfExists('wallet_parking');
    }
};
