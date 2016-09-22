<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemesterRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semester_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lecturerID');
            $table->string('year');
            $table->string('batchNo');
            $table->string('subjectCode');
            $table->string('requestDate');
            $table->string('timeSlot');
            $table->string('resourceID');
            $table->string('status');
            $table->string('semester');
            $table->string('timeslotType');
            $table->string('ResourceType');
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
        Schema::drop('semester_requests');
    }
}
