<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('staff_id')->unique()->index();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('admin');
            $table->string('picture')->default("avatar5.png");
            $table->rememberToken();
            $table->timestamps();
            
            $table->foreign('staff_id')->references('staff_id')->on('allowed_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
