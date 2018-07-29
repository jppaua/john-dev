<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\User::class, function (Faker $faker) {
    $countryCodes = array_keys(config('constants.COUNTRY_NAME'));

    return [
//        'first_name' => $faker->firstName,
//        'last_name' => $faker->lastName,
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'gender' => rand(1,2) == 1 ? 'male' : 'female',
        'remember_token' => str_random(10),
        'country_code' => $countryCodes[array_rand($countryCodes)],
        'profile_id' => factory(\App\Profile::class)->create()->id
    ];
});

$factory->define(\App\Membership::class, function (Faker $faker) {
    return [
        'user_id' => factory(\App\User::class)->create()->id,
        'uuid' => $faker->uuid,
    ];
});

$factory->define(\App\Profile::class, function (Faker $faker) {
    $profileBackground = 'background.jpg';
    $profileImg = 'profile' . rand(1,10) . '.jpg';

    return [
        'content' => $faker->paragraph,
        'title' => $faker->jobTitle,
        'background_img' => $profileBackground,
        'profile_img' => $profileImg,
    ];
});

$factory->define(\App\Merchant::class, function (Faker $faker) {
    $countryCodes = array_keys(config('constants.COUNTRY_NAME'));

    return [
        'company_name' => $faker->company,
        'country_code' => $countryCodes[array_rand($countryCodes)],
        'profile_id' => factory(\App\Profile::class)->create()->id,
    ];
});

$factory->define(App\PostalAddress::class, function (Faker $faker) {
    static $addressable_id, $type;

    $countryCodes = array_keys(config('constants.COUNTRY_NAME'));
    $randomCountryCode = $countryCodes[array_rand($countryCodes)];
    $randomCountryName = config('constants.COUNTRY_NAME')[$randomCountryCode];

    return [
        'addressable_id' => $addressable_id ?: $addressable_id = 1,
        'locality' => $faker->city,
        'region' => $faker->state,
        'office_box_number' => '',
        'postal_code' => $faker->postcode,
        'street_address' => $faker->streetAddress,
        'country_code' => $randomCountryCode,
        'type' => 'current',
        'addressable_type' => $type ?: $type = 'App\User'
    ];
});

$factory->define(App\Thread::class, function ($faker){
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'channel_id' => function () {
            return factory('App\Channel')->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});

$factory->define(App\Reply::class, function ($faker){
    return [
        'thread_id' => function() {
            return factory('App\Thread')->create()->id;
        },
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'body' => $faker->paragraph
    ];
});

$factory->define(App\Channel::class, function ($faker){
    $name = $faker->word;


    return [
        'name' => $name,
        'slug' => $name
    ];
});