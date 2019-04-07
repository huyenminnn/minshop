<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_code');
            $table->integer('customer_id');
            $table->string('customer_name',50);
            $table->string('address',255);
            $table->string('customer_mobile',15);
            $table->string('status');
            $table->string('note')->nullable();
            $table->string('delivery_unit')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('reason_reject')->nullable();
            $table->integer('user_id');
            $table->double('total');
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
        Schema::dropIfExists('orders');
    }
}
