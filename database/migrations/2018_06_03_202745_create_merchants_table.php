<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('company_name');
            $table->enum('country_code', array_keys(config('constants.COUNTRY_NAME')));
            
            $table->integer('profile_id')->unsigned();
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('merchant_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('merchant_id');
            $table->integer('user_id');

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
        Schema::dropIfExists('merchants');
        Schema::dropIfExists('merchant_user');
    }
}
