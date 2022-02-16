<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionDBListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_d_b_lists', function (Blueprint $table) {
            $table->id();
            $table->string('db_name')->unique();
            $table->string('db_username');
            $table->string('db_password');
            $table->enum('status', ['0', '1', '2']);
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
        Schema::dropIfExists('subscription_d_b_lists');
    }
}
