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
            $table->unsignedBigInteger('user_role_id');
            $table->unsignedBigInteger('page_role_id');
            $table->unsignedBigInteger('page_id');
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
