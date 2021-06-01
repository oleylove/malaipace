<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->collation = 'utf8_unicode_ci';
            $table->charset = 'utf8';
            $table->increments('id')->comment('รหัสห้อง');
            $table->integer('typ_id')->comment('รหัสประเภท');
            $table->string('number',10)->comment('เลขห้อง');
            $table->string('building',10)->comment('ตึก');
            $table->string('status',20)->comment('สถานะ');
            $table->integer('meter_wo')->default(0)->comment('มิเตอร์น้ำเก่า');
            $table->integer('meter_wn')->default(0)->comment('มิเตอร์น้ำล่าสุด');
            $table->integer('meter_po')->default(0)->comment('มิเตอร์ไฟเก่า');
            $table->integer('meter_pn')->default(0)->comment('มิเตอร์ไฟล่าสุด');
            $table->string('photo1',30)->nullable()->comment('รูปห้อง1');
            $table->string('photo2',30)->nullable()->comment('รูปห้อง2');
            $table->string('photo3',30)->nullable()->comment('รูปห้อง3');
            $table->string('photo4',30)->nullable()->comment('รูปห้อง4');
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
        Schema::drop('rooms');
    }
}
