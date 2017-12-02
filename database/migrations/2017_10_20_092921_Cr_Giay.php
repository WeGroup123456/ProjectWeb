<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrGiay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Giay', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Ten');
            $table->string('TenKhongDau');
            $table->text('TomTat');
            $table->longText('NoiDung');
            $table->string('HinhBe');
            $table->string('HinhLon');
            $table->integer('NoiBat')->default(0);
            $table->integer('LuotXem')->default(0);
            $table->integer('LuotThich')->default(0);
            $table->integer('Size'); // 36->44 ? 
            $table->integer('GioiTinh')->default(0);
            $table->integer('GiaCu');
            $table->integer('GiaMoi');
            $table->integer('Total');
            $table->integer('Status')->default(0);
            $table->integer('idLoaiGiay')->unsigned();
            $table->foreign('idLoaiGiay')->references('id')->on('LoaiGiay');
            $table->integer('idBrand')->unsigned();
            $table->foreign('idBrand')->references('id')->on('Brand');
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
        Schema::drop('Giay');    }
}
