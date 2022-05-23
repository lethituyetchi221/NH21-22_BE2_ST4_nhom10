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
            // $table->increments('id');
            // $table->string('username');
            // $table->string('password');
            // $table->string('email');
            // $table->string('image');
            // $table->string('phone');
            // $table->string('token_cart');          
            // $table->integer('type_user_id');
            // $table->foreign('type_user_id')->references('id')->on('type_users')->onDelete('cascade');
            // $table->integer('role_id');
            // $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            // $table->timestamps();
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->integer('role');
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
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
        Schema::dropIfExists('users');
    }
}
