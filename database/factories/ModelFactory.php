<?php

use Faker\Generator as Faker;

use BenditaFome\Models\Coupon;
use BenditaFome\Models\OrderItem;
use BenditaFome\Models\User;
use BenditaFome\Models\Category;
use BenditaFome\Models\Product;
use BenditaFome\Models\Client;
use BenditaFome\Models\Order;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name'           => $faker->name,
        'email'          => $faker->email,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'        => $faker->word,
        'description' => $faker->sentence,
        'price'       => $faker->numberBetween(10, 50),
    ];
});

$factory->define(Client::class, function (Faker $faker) {
    return [
        'phone'    => $faker->phoneNumber,
        'address'  => $faker->address,
        'city'     => $faker->city,
        'state'    => $faker->state,
        'postcode' => $faker->postcode,
    ];
});

$factory->define(Order::class, function (Faker $faker) {
    return [
        'client_id' => rand(1, 10),
        'total'     => $faker->numberBetween(10, 50),
        'status'    => 0,
    ];
});

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        'product_id' => rand(1, 5),
        'quantity'   => 2,
        'price'      => 50,
    ];
});

$factory->define(Coupon::class, function (Faker $faker) {
    return [
        'code'  => $faker->uuid,
        'value' => $faker->randomFloat(null, 50, 100),
    ];
});



