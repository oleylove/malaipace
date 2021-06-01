<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->collation = 'utf8_unicode_ci';
            $table->charset = 'utf8';
            $table->bigIncrements('id')->comment('รหัสแจ้งซ่อม');
            $table->integer('rm_id')->nullable()->comment('รหัสห้องแจ้ง');
            $table->date('date')->comment('วันแจ้งซ่อม');
            $table->datetime('ready_date')->comment('วันที่ต้องการซ่อม');
            $table->text('detail')->comment('รายละเอียด');
            $table->string('status')->comment('สถานะ');
            $table->integer('price')->default(0)->comment('ค่าซ่อม');
            $table->timestamp('date_done')->nullable()->comment('วันซ่อมเสร็จ');
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
        Schema::drop('maintenances');
    }
}
