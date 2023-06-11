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
        Schema::create('produk_warna', function (Blueprint $table) {
            $table->id();
            $table->string('warna',25);
            $table->string('qty',4);
            $table->unsignedBigInteger('produk_id');
            $table->timestamps();

            $table->foreign('produk_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_warna');
    }
};
