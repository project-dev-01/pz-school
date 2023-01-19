<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesPaymentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees_payment_history', function (Blueprint $table) {
            $table->id();
            $table->integer('allocation_id');
            $table->integer('fees_type_id');
            $table->string('collect_by');
            $table->string('amount');
            $table->string('discount');
            $table->string('fine');
            $table->string('pay_via');
            $table->text('remarks');
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
        Schema::dropIfExists('fees_payment_history');
    }
}
