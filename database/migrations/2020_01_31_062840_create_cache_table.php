<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCacheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->unique();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('filials', function (Blueprint $table) {
            $table->increments('id_filial')->unique()->primary()->autoIncrement();
            $table->mediumText('name_filial');
            $table->dateTime('date_create')->default('CURRENT_TIMESTAMP');
        });

        Schema::create('stations', function (Blueprint $table) {
            $table->increments('id_station')->unique()->primary()->autoIncrement();
            $table->mediumText('name_station');
            $table->mediumText('link_station');
            $table->integer('id_filial');
            $table->dateTime('date_create')->default('CURRENT_TIMESTAMP');
            $table->foreign('id_filial')->references('id_filial')->on('filials')->onDelete('cascade');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id_user')->unique()->primary()->autoIncrement();
            $table->mediumText('email')->always();
            $table->mediumText('remember_token');
            $table->mediumText('password');
            $table->dateTime('date_create')->default('CURRENT_TIMESTAMP');
        });

        Schema::create('grants', function (Blueprint $table) {
            $table->increments('id_grants')->unique()->primary()->autoIncrement();
            $table->mediumText('grant_name')->always();
            $table->mediumText('grant_name_rus');
            $table->dateTime('date_create')->default('CURRENT_TIMESTAMP');
        });

        Schema::create('user_grants', function (Blueprint $table) {
            $table->increments('id_user_grants')->unique()->primary()->autoIncrement();
            $table->mediumText('id_user')->always();
            $table->mediumText('id_grants');
            $table->dateTime('date_create')->default('CURRENT_TIMESTAMP');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
            $table->foreign('id_grants')->references('id_grants')->on('grants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cache');
    }
}
