<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id('class_id');
            $table->string('unit_id');
            $table->string('lec_id');
            $table->string('class_sem');
            $table->string('class_year');
            $table->dateTime('class_start');
            $table->dateTime('class_stop');
            $table->string('status');
            $table->longText('class_code');
            $table->dateTime('date_updated');
            $table->dateTime('date_reg');
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
        Schema::dropIfExists('classes');
    }
}
