<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Zaiko;
use Faker\Generator as Faker;

$factory->define(Zaiko::class, function (Faker $faker) {
    return [
        'name'=>$faker->word(),
        'kazu'=>$faker->randomDigitNotNull(),
        'kakaku'=>$faker->randomDigitNotNull(),
        'shosai'=>$faker->realText(),
        'jyoukyou'=>'在庫確認'
    ];
});
