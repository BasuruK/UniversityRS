<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lecturerID');
            $table->string('year');
            $table->string('batchNo');
            $table->string('subjectCode');
            $table->string('requestDate');
            $table->string('timeSlot');
            $table->string('resourceID');
            $table->string('status');
            $table->timestamps();


            $table->foreign('batchNo')->references('batchNo')->on('batch')->onDelete('cascade');
            $table->foreign('subjectCode')->references('subCode')->on('subject')->onDelete('cascade');
            $table->foreign('resourceID')->references('id')->on('resource')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('requests');
    }
}
