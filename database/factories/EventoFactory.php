<?php

use Faker\Generator as Faker;

$factory->define(App\Evento::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'titulo' => 'Marriage of ' . $faker->name('female'),
        'descricao' => $faker->realText(220),
        'data' => $faker->dateTimeBetween('now', '+5 years'),
        'valor' => $faker->randomFloat(2, 0, 1000),
        'created_at' => $faker->dateTimeBetween('-2 years', '-1 year'),
        'updated_at' => $faker->dateTimeBetween('-6 months', 'now')
    ];
});
