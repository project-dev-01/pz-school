<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('relation');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('occupation');
            $table->string('income');
            $table->string('education');
            $table->string('email');
            $table->string('mobile_no');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('photo');
            $table->string('facebook_url');
            $table->string('linkedin_url');
            $table->string('twitter_url');
            $table->boolean('active');
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
        Schema::dropIfExists('parent');
    }
}
