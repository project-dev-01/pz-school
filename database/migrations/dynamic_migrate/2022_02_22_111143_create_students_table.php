<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->string('register_no');
            $table->date('admission_date');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('birthday');
            $table->string('religion');
            $table->string('caste');
            $table->string('blood_group');
            $table->string('mother_tongue');
            $table->text('current_address');
            $table->text('permanent_address');
            $table->string('city');
            $table->string('state');
            $table->string('mobile_no');
            $table->integer('category_id');
            $table->string('email');
            $table->integer('route_id')->nullable();
            $table->integer('vehicle_id')->nullable();
            $table->integer('hostel_id')->nullable();
            $table->integer('room_id')->nullable();
            $table->text('previous_details');
            $table->string('photo');
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
        Schema::dropIfExists('students');
    }
}
