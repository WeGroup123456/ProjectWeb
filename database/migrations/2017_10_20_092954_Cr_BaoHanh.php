<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrBaoHanh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BaoHanh', function (Blueprint $table) {
            $table->increments('id');
            $table->string('TieuDe');
            $table->integer('Kieu');
            $table->string('TenKhongDau');
            $table->string('TomTat');
            $table->string('NoiDung');
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
        Schema::drop('BaoHanh');
    }
}
