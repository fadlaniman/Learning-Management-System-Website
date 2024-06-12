<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->enum('type', ['material', 'assignment']);
            $table->dateTime('deadline')->nullable();
            $table->string('file');
            $table->string('user_id');
            $table->string('class_id');
            $table->timestamps();
            $table->foreign('user_id')->references('uid')->on('users');
            $table->foreign('class_id')->references('id')->on('class');
        });

 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
