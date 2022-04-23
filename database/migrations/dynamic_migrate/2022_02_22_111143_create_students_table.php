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
            $table->string('year');
            $table->string('register_no');
            $table->string('roll_no');
            $table->date('admission_date');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender')->nullable();
            $table->string('birthday')->nullable();
            $table->string('religion')->nullable();
            $table->string('caste')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('mother_tongue')->nullable();
            $table->text('current_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('mobile_no');
            $table->integer('category_id');
            $table->string('email');
            $table->integer('route_id')->nullable();
            $table->integer('vehicle_id')->nullable();
            $table->integer('hostel_id')->nullable();
            $table->integer('room_id')->nullable();
            $table->text('previous_details')->nullable();
            $table->string('photo')->nullable();
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
