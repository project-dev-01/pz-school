<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soap', function (Blueprint $table) {
            $table->id();
            $table->integer('soap_notes_id');
            $table->string('notes');
            $table->integer('soap_category_id');
            $table->integer('soap_sub_category_id');
            $table->string('referred_by');
            $table->date('date');
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
        Schema::dropIfExists('soap');
    }
}
