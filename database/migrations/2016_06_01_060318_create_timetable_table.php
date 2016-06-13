<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimetableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetable', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('year')->index();
            $table->string('batchNo')->index();
            $table->string('subjectCode');
            $table->string('timeSlot');
            $table->string('day');
            $table->string('resourceName');
            $table->string('lecturerName');
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
        Schema::drop('timetable');
    }
}
