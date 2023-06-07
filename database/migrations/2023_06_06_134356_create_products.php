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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id');
            $table->string('name');
            $table->string('slug');
            $table->string('brand')->nullable();
            $table->longText('deskripsi')->nullable();

            $table->string('harga_asli',11);
            $table->string('harga_jual',11);
            $table->integer('jumlah');
            $table->tinyInteger('trending')->default('0')->comment('0=>not, 1:trending');
            $table->tinyInteger('status')->default('1')->comment('0=>hide, 1:visible');

            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_deskripsi')->nullable();

            $table->foreign('kategori_id')->references('id')->on('categories')->onDelete('cascade');

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
        Schema::dropIfExists('products');
    }
};
