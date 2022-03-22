<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendors', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subject_id');
            $table->string('timing');
            $table->string('teacher_id');
            $table->string('sem_id');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->dateTime('calendor_color_id');
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
        Schema::dropIfExists('calendors');
    }
}
