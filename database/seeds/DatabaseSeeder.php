<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 10)->create()->each(function ($user){
            $user->pessoa()->save(factory(\App\Pessoa::class)->make());
        });

        factory(\App\Evento::class, 60)->create();
    }
}
