<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->collation = 'utf8_unicode_ci';
            $table->charset = 'utf8';
            $table->increments('id')->comment('รหัสประเภท');
            $table->string('name',100)->comment('ประเภท');
            $table->integer('price')->default(0)->comment('ค่าเช่าห้อง');
            $table->integer('water')->default(0)->comment('ค่าน้ำต่อหน่วย');
            $table->integer('power')->default(0)->comment('ค่าไฟต่อหน่วย');
            $table->integer('centric')->default(0)->comment('ค่าส่วนกลาง');
            $table->integer('wifi')->default(0)->comment('ค่าอินเตอร์เน็ต');
            $table->integer('vehicle')->default(0)->comment('ค่าที่จอดรถ');
            $table->integer('mulct')->default(0)->comment('ค่าล่าช้าต่อวัน');
            $table->integer('booking')->default(0)->comment('ค่าจอง');
            $table->integer('doposit')->default(0)->comment('ค่ามัดจำ');
            $table->string('photo',100)->nullable()->comment('รูปภาพ');
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
        Schema::drop('types');
    }
}
