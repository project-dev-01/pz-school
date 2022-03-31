<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GradeMarks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_marks', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->integer('min_mark');
            $table->integer('max_mark');       
            $table->string('grade');  
            $table->integer('grade_point');
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
        //
    }
}
