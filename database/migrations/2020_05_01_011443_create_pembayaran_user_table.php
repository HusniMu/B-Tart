<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('transaction_id')->unsigned();
            $table->integer('user_id');
            $table->foreign('transaction_id')
                ->references('id')->on('pembayarans')
                ->onDelete('cascade');
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
        Schema::dropIfExists('pembayaran_user');
    }
}
