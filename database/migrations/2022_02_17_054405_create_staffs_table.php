<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id');
            $table->string('name');
            $table->integer('department');
            $table->string('qualification');
            $table->string('joining_date');
            $table->string('birthday');
            $table->string('gender');
            $table->string('religion');
            $table->string('blood_group');
            $table->text('present_address');
            $table->text('permanent_address');
            $table->string('mobile_no');
            $table->string('email');
            $table->integer('branch_id')->nullable();;
            $table->string('photo')->nullable();;
            $table->string('facebook_url')->nullable();;
            $table->string('linkedin_url')->nullable();;
            $table->string('twitter_url')->nullable();;
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
        Schema::dropIfExists('staffs');
    }
}
