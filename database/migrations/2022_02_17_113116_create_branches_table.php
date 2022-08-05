<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->text('branch_code')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('db_name');
            $table->string('db_username');
            $table->string('db_password')->nullable();
            $table->string('school_name');
            $table->string('branch_name')->nullable();
            $table->string('school_code')->nullable();
            $table->string('passport');
            $table->string('nric_number');
            $table->string('email');
            $table->string('mobile_no');
            $table->string('currency');
            $table->string('symbol');
            $table->integer('country_id');
            $table->integer('state_id');
            $table->integer('city_id');
            $table->string('post_code')->nullable();
            $table->text('address');
            $table->text('address1')->nullable();
            $table->tinyInteger('status');
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('branches');
    }
}
