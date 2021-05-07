<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('SocialMedia');
            $table->date('dateOfBirth');
            $table->string('gender');
            $table->string('urlAvatar')->nullable();
            $table->tinyInteger('FreeTrial')->default(0);
            $table->tinyInteger('Banned')->default(0);
            $table->tinyInteger('VIP')->default(0);
            $table->date('VIP_expired')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->tinyInteger('ShareInfo')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('users');
    }
}
