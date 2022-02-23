<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_tests', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->date('date');
            $table->integer('class_id');
            $table->integer('section_id');
            $table->integer('subject_id');
            $table->string('test_name');
            $table->string('test_marks');
            $table->string('grade_status');
            $table->text('remarks');
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
        Schema::dropIfExists('short_tests');
    }
}
