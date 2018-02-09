<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('firstname', 100);
            $table->char('MI', 1);
            $table->string('lastname', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile');
            $table->string('address');
            $table->char('confirm_key',10)->nullable();
            $table->char('key',10)->nullable();
            $table->enum('role_type',['NORMAL','ADMIN']);
            $table->rememberToken();
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
