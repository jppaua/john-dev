<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostalAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postal_addresses', function (Blueprint $table) {
            $table->increments('id');
            
            $table->morphs('addressable');
            
            $table->string('locality');
            $table->string('region');
            $table->string('office_box_number', 10);
            $table->string('postal_code', 10);
            $table->string('street_address');

            $table->enum('country_code', array_keys(config('constants.COUNTRY_NAME')));
            $table->enum('type', config('enums.postal_address_type'));

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
        Schema::dropIfExists('postal_addresses');
    }
}
