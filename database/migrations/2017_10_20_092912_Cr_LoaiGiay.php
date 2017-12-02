<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrLoaiGiay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('LoaiGiay', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idBrand')->unsigned();
            $table->foreign('idBrand')->references('id')->on('Brand');
            $table->string('Ten');
            $table->string('TenKhongDau');
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
        Schema::drop('LoaiGiay');
    }
}
