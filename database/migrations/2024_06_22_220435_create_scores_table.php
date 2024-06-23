<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('value');
            $table->string('user_id');
            $table->string('class_id');
            $table->unsignedBigInteger('attachment_id');
            $table->unsignedBigInteger('submission_id');
            $table->timestamps();
            $table->foreign('user_id')->references('uid')->on('users');
            $table->foreign('class_id')->references('id')->on('class');
            $table->foreign('attachment_id')->references('id')->on('attachments');
            $table->foreign('submission_id')->references('id')->on('submissions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
