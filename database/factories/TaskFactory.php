<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
			'title' => $faker->sentence,
			'description' => $faker->paragraph,
			'user_id' => function () {
				return factory(App\User::class)->create()->id;
			},
    ];
});