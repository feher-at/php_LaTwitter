<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Http\Models\ProductModel;
use Faker\Generator as Faker;

$factory->define(App\Http\Models\ProductModel::class, function (Faker $faker) {
    return [
            'product_name' => $faker->name,
            'product_price' => $faker->numberBetween(0,1000000),
            'product_sale_price' =>$faker->numberBetween(0,1000000),
            'product_description' =>$faker->text,
            'created_at'=>now(),
            'updated_at'=>$faker->dateTime,

        //
    ];
});
