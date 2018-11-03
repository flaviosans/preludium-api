<?php

use Faker\Generator as Faker;

$factory->define(App\Pessoa::class, function (Faker $faker) {
    return [
        'nome' => $faker->name(),
        'endereco' => $faker->address(),
        'telefone' => $faker->phoneNumber()
    ];
});
