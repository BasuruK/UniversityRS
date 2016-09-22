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
            $table->increments('id')->unsigned();
            $table->string('lecturerID');
            $table->string('year')->nullable();
            $table->string('batchNo')->nullable();
            $table->string('subjectCode')->nullable();
            $table->string('requestDate');
            $table->string('timeSlot');
            $table->string('resourceID')->nullable();
            $table->string('status');
            $table->string('timeslotType');
            $table->string('capacity')->nullable();
            $table->string('specialEvent')->nullable();
            $table->string('ResourceType');
            $table->timestamps();

        });

        Schema::table('requests', function($table) {

            $table->foreign('batchNo')->references('batchNo')->on('batch')->onDelete('cascade');
            $table->foreign('subjectCode')->references('subCode')->on('subject')->onDelete('cascade');
            $table->foreign('resourceID')->references('hallNo')->on('resource')->onDelete('cascade');

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
