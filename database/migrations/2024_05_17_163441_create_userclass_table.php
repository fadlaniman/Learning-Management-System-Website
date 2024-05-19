<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_class', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('class_id');
            $table->timestamps();
            $table->foreign('user_id')->references('uid')->on('users');
            $table->foreign('class_id')->references('id')->on('class');
            $table->unique(['user_id', 'class_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user__class');
    }
}
