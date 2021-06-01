<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->collation = 'utf8_unicode_ci';
            $table->charset = 'utf8';
            $table->bigIncrements('id')->comment('รหัสใบแจ้งหนี้');
            $table->integer('les_id')->comment('รหัสเช่า');
            $table->date('date')->comment('วันออกใบแจ้งหนี้');
            $table->timestamp('date_pay')->nullable()->comment('วันแจ้งชำระเงิน');
            $table->date('pay_date')->nullable()->comment('วันกำหนดชำระเงิน');
            $table->integer('delay_date')->default(0)->comment('วันเกินกำหนด');
            $table->integer('meter_wo')->comment('มิเตอร์น้ำเก่า');
            $table->integer('meter_wn')->comment('มิเตอร์น้ำใหม่');
            $table->integer('meter_wu')->comment('จำนวนหน่วย');
            $table->integer('meter_wpu')->comment('ค่าน้ำต่อหน่วย');
            $table->integer('meter_wtp')->comment('รวมค่าน้ำ');
            $table->integer('meter_po')->comment('มิเตอร์ไฟเก่า');
            $table->integer('meter_pn')->comment('มิเตอร์ไฟใหม่');
            $table->integer('meter_pu')->comment('จำนวนหน่วย');
            $table->integer('meter_ppu')->comment('ค่าไฟต่อหน่วย');
            $table->integer('meter_ptp')->comment('รวมค่าไฟ');
            $table->integer('typ_centric')->comment('ค่าส่วนกลาง');
            $table->integer('typ_wifi')->comment('ค่าอินเตอร์เน็ต');
            $table->integer('typ_vehicle')->comment('ค่าที่จอดรถ');
            $table->integer('typ_mulct')->comment('ค่าปรับล่าช้า');
            $table->integer('les_price')->comment('ค่าเช่าห้อง');
            $table->integer('net_pay')->comment('จ่ายสุทธิ');
            $table->integer('typ_doposit')->default(0)->comment('คืนค่าประกัน');
            $table->string('status',20)->nullable()->comment('สถานะใบแจ้งหนี้');
            $table->string('slip')->nullable()->comment('สถานะใบแจ้งหนี้');
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
        Schema::drop('invoices');
    }
}
