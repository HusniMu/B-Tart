<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('post_id')->nullable();
            $table->text('custom_order_id')->nullable();
            $table->bigInteger('users_id')->nullable();
            $table->bigInteger('transaction_total');
            $table->string('nama');
            $table->string('email');
            $table->text('alamat_lengkap');
            $table->string('zip');
            $table->string('no_hp');
            $table->string('transaction_status');
            $table->softDeletes();
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
        Schema::dropIfExists('transactions');
    }
}
