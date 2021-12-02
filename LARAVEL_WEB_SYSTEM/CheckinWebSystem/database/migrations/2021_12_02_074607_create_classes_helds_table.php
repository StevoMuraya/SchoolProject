<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesHeldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes_held', function (Blueprint $table) {
            $table->id();
            $table->string('class_id');
            $table->dateTime('class_start');
            $table->dateTime('class_stop');
            $table->longText('class_code');
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
        Schema::dropIfExists('classes_held');
    }
}
