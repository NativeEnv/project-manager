<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('id_project')->references('id')->on('project');
            /**
             * Where did the user come from
             */
            $table->string('from');
            /**
             * Identity user
             */
            $table->integer('id_user')->references('id')->on('user')->nullable();
            $table->integer('id_user_fingerprint')->references('id')->on('user_fingerprint')->nullable();

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
        Schema::dropIfExists('history');
    }
}
