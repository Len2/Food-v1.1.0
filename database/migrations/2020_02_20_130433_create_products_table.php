<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
           // $table->unsignedBigInteger('page_category_id');
            $table->unsignedBigInteger('page_id')->unsigned()->nullable()->index();

            $table->string('name');
            $table->text('description');
            $table->boolean('active')->default('0');
            $table->decimal('initial_price',30,2)->default('0.00');
            $table->decimal('price',30,2)->default('0.00');

            $table->string('image');
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
        Schema::dropIfExists('products');
    }
}
