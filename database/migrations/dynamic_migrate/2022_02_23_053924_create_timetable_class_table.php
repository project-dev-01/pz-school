<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetableClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetable_class', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id');
            $table->integer('section_id');
            $table->string('break');
            $table->integer('subject_id');
            $table->string('teacher_id');
            $table->integer('semester_id')->nullable();
            $table->integer('session_id')->nullable();
            $table->string('class_room')->nullable();
            $table->time('time_start');
            $table->time('time_end');
            $table->string('day');
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
        Schema::dropIfExists('timetable_class');
    }
}
