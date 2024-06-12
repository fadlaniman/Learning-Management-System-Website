<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('file');
            $table->string('user_id');
            $table->string('class_id');
            $table->unsignedBigInteger('attachment_id');
            $table->timestamps();
            $table->foreign('user_id')->references('uid')->on('users');
            $table->foreign('class_id')->references('id')->on('class');
            $table->foreign('attachment_id')->references('id')->on('attachments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
}
