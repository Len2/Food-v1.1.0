<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->unsignedBigInteger('user_id');
            $table->string('row_id'); // id cart shop
            $table->string('payment_id');

            $table->string('email');
            $table->string('name_cart');
            $table->string('address');

            $table->string('city');
            $table->string('province');
            $table->string('zip_code');
            $table->string('country');
            $table->string('phone');
            $table->string('method_payment');
            $table->decimal('amount',30,2);
            $table->string('currency');

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
