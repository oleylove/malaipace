<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebconfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('webconfigs', function (Blueprint $table) {
            $table->collation = 'utf8_unicode_ci';
            $table->charset = 'utf8';
            $table->increments('id');
            $table->string('title',100)->nullable();
            $table->string('website',100)->nullable();
            $table->text('address')->nullable();
            $table->string('bbl')->default('เลขบัญชี xxx-x-xxxxx-x ชื่่อบัญชี Apartment Management System');
            $table->string('bbl_logo')->nullable();
            $table->string('kbsnk')->default('เลขบัญชี xxx-x-xxxxx-x ชื่่อบัญชี Apartment Management System');
            $table->string('kbsnk_logo')->nullable();
            $table->string('scb')->default('เลขบัญชี xxx-x-xxxxx-x ชื่่อบัญชี Apartment Management System');
            $table->string('scb_logo')->nullable();
            $table->string('bay')->default('เลขบัญชี xxx-x-xxxxx-x ชื่่อบัญชี Apartment Management System');
            $table->string('bay_logo')->nullable();
            $table->string('logo')->nullable();
            $table->string('photo1',100)->nullable();
            $table->string('photo2',100)->nullable();
            $table->string('photo3',100)->nullable();
            $table->string('photo4',100)->nullable();
            $table->string('photo5',100)->nullable();
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
        Schema::drop('webconfigs');
    }
}
