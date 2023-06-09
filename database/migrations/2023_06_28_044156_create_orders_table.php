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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('transaksi_id');
            $table->integer('user_id');
            $table->string('address');
            $table->string('qty');
            $table->string('total_harga');
            $table->string('tipe_pembayaran')->nullable();
            $table->string('payToken')->nullable();
            $table->string('status_pembayaran',30);
            $table->char('status_order',1)->nullable()->comment('1 = diproses, 2 = dikirim, 0 = selesai ');
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
        Schema::dropIfExists('orders');
    }
};
