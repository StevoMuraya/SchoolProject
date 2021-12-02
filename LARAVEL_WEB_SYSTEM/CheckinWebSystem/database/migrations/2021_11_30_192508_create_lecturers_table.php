<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id('lec_id');
            $table->string('lec_firstname');
            $table->string('lec_lastname');
            $table->string('lec_email');
            $table->string('lec_phone');
            $table->string('lec_code');
            $table->string('lec_image');
            $table->string('lec_password');
            $table->string('date_reg');
            $table->string('reg_by');
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
        Schema::dropIfExists('lecturers');
    }
}
