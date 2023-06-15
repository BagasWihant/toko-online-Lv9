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
    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {

            $table->string('meta_title');
            $table->string('meta_keyword');
            $table->mediumText('meta_description');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {

            $table->dropColumn(['meta_title','meta_keyword','meta_description']);

        });
    }
};
