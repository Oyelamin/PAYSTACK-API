<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargeCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charge_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('card_id');
            $table->string('domain');
            $table->string('status');
            $table->string('reference');
            $table->string('amount');
            $table->string('message');
            $table->string('gateway_response');
            $table->string('paid_at');
            $table->string('card_created_at');
            $table->string('channel');
            $table->string('currency');
            $table->string('ip_address');
            $table->string('metadata');
            $table->string('log');
            $table->string('fees');
            $table->string('fees_split');
            $table->string('authorization');
            $table->string('customer');
            $table->string('plan');
            $table->string('paidAt');
            $table->string('createdAt');
            $table->string('transaction_date');
            $table->string('plan_object');
            $table->string('subaccount');
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
        Schema::dropIfExists('charge_cards');
    }
}
