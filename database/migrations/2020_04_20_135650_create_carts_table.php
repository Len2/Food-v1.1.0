<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->unsigned()->nullable()->index();
            $table->integer('product_id');
            $table->integer('page_id');

            $table->string('name');
            $table->integer('qty');
            $table->text('desc');
            $table->boolean('status')->default('0');

            $table->decimal('price',30,2);
            $table->decimal('tax',30,2);
            $table->decimal('total',30,2);

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
        Schema::dropIfExists('carts');
    }
}
