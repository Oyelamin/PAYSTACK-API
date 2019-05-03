<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('authorization_code');
            $table->string('bin');
            $table->string('last4');
            $table->string('exp_month');
            $table->string('exp_year');
            $table->string('channel');
            $table->string('card_type');
            $table->string('bank');
            $table->string('country_code');
            $table->string('brand');
            $table->string('reusable');
            $table->string('signature');
            $table->string('customer');
            $table->string('card_number');
            $table->string('cvv');
            $table->string('email');
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
        Schema::dropIfExists('cards');
    }
}
