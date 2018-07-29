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
//            $table->string('first_name')->nullable();
//            $table->string('last_name')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);

            $table->enum('country_code', array_keys(config('constants.COUNTRY_NAME')));
            $table->enum('gender', config('enums.gender'))->default('unknown');

            $table->date('birthday')->nullable();

            $table->integer('profile_id')->unsigned();
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');

            $table->rememberToken();
            $table->softDeletes();
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
