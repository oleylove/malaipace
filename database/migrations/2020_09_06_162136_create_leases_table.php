<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leases', function (Blueprint $table) {
            $table->collation = 'utf8_unicode_ci';
            $table->charset = 'utf8';
            $table->bigIncrements('id')->comment('รหัสเช่า');
            $table->integer('rm_id')->comment('รหัสห้องเช่า');
            $table->integer('user_id')->comment('รหัสห้องผู้เช่า');
            $table->integer('inc_id')->comment('รหัสบัญชี');
            $table->string('idcard',17)->comment('รหัสบัตร');
            $table->date('date_start')->nullable()->comment('วันจอง-วันเช่า');
            $table->date('date_end')->nullable()->comment('ครบสัญญาเช่า');
            $table->string('vehicle',50)->default('ไม่มี')->comment('พาหนะ');
            $table->string('vehicle_reg',100)->default('ไม่มี')->comment('ทะเบียน');
            $table->integer('number')->nullable()->comment('ผู้อาศัย');
            $table->string('typ_wifi',5)->default('no')->comment('ใช้wifi');
            $table->string('typ_vehicle',5)->default('no')->comment('เช่าที่จอดรถ');
            $table->integer('typ_price')->comment('ค่าเช่าห้อง');
            $table->integer('typ_booking')->comment('ค่าจอง');
            $table->integer('typ_doposit')->comment('ค่ามัดจำ');
            $table->integer('net_pay')->nullable()->comment('รวมจ่ายสุทธิ');
            $table->integer('meter_ws')->nullable()->comment('มิเตอร์น้ำเริ่มต้น');
            $table->integer('meter_ps')->nullable()->comment('มิเตอร์ไฟเริ่มต้น');
            $table->string('status',20)->nullable()->comment('สถานะเช่า');
            $table->string('bkg_slip',30)->nullable()->comment('สลิปค่าจอง');
            $table->string('idcard_doc',30)->nullable()->comment('สำเนาบัตร');
            $table->string('lease_doc',30)->nullable()->comment('สัญญา');
            $table->timestamp('checkout')->nullable()->comment('วันแจ้งย้าย');
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
        Schema::drop('leases');
    }
}
