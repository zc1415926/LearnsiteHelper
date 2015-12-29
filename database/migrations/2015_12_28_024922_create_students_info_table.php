<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Sid');
            $table->unsignedTinyInteger('Sgrade');
            $table->unsignedTinyInteger('Sclass');
            $table->string('Sname');
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
        Schema::drop('students_info');
    }
}