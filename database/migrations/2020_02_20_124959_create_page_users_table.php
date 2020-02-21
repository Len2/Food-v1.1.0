<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_role_id');
            $table->integer('page_role_id');
            $table->integer('page_id');
            //$table->foreign('user_role_id')->references('id')->on('UserRole')->onDelete('cascade');
            //$table->foreign('page_role_id')->references('id')->on('PageRole')->onDelete('cascade');
            //$table->foreign('page_id')->references('id')->on('Page')->onDelete('cascade');
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
        Schema::dropIfExists('page_users');
    }
}
