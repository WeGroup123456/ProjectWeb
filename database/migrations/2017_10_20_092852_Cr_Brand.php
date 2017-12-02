<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrBrand extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Brand', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idLoaiGiay')->unsigned();
            /*$table->foreign('idLoaiGiay')->references('id')->on('LoaiGiay');*/
            $table->string('Ten');
            $table->string('TenKhongDau');
            $table->string('MoTa');
            $table->string('Hinh');
            $table->string('Logo');
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
        Schema::drop('Brand');
    }
}
