<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Comments', function (Blueprint $table) {
          $table->id();
          $table->integer('IdMovie');
          $table->integer('IdUser');
          $table->integer('IdParentUser')->nullable();
          $table->string('Body');
          $table->tinyInteger('Flag')->default(1);
          $table->integer('Like')->default(0);
          $table->integer('Dislike')->default(0);
          $table->integer('Sumlike')->default(0);
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
        Schema::dropIfExists('comment');
    }
}
