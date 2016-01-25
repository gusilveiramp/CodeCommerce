<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(CodeCommerce\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(CodeCommerce\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
    ];
});

$factory->define(CodeCommerce\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->randomNumber(2),
        'featured' => 1,
        'recommended' => $faker->boolean,
        'category_id' => 1,
    ];
});

$factory->define(CodeCommerce\Color::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->hexcolor,
    ];
});

$factory->define(CodeCommerce\ProductColor::class, function (Faker\Generator $faker) {
    return [
        'product_id' => 1,
        'color_id' => 1,
    ];
});