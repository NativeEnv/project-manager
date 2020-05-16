<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_meta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_history')->references('id')->on('history');;
            $table->string('user_agent');
            $table->string('language');
            $table->integer('timezone');
            $table->integer('screen_width');
            $table->integer('screen_height');
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
        Schema::dropIfExists('history_meta');
    }
}
