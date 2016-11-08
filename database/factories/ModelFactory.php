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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Batch::class, function (Faker\Generator $faker) {

    return [
        'ori_num' => str_random(5),
        'py_num' => str_random(5),
        'samples_type' => $faker->numberBetween(1, 3),
        'samples_amount' => $faker->numberBetween(1, 3),
        'trans_method'=> $faker->numberBetween(1, 3),
        'arrive_time' => \Carbon\Carbon::now(),
        'arrive_status' => $faker->numberBetween(1, 3),
        'store_method' => $faker->numberBetween(1, 3),
        'store_location' => $faker->sentence,
        'sender' => $faker->name,
        'sender_contact' => $faker->phoneNumber,
        'send_time' => \Carbon\Carbon::now(),
        'recipients' => $faker->name,
        'express_num' => str_random(10),
        'note' => $faker->sentence,
        'manager' => $faker->numberBetween(1, 20)
    ];
});

$factory->define(App\Sample::class, function (Faker\Generator $faker) {

    return [
        'batch_id' => 1,
        'client_id' => $faker->numberBetween(1, 20),
        'ori_num' => str_random(5),
        'py_num' => str_random(5),
        'sample_weight' => $faker->numberBetween(1, 6),
        'sample_date' => \Carbon\Carbon::now()
    ];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
        'start' => \Carbon\Carbon::now(),
        'end' => \Carbon\Carbon::now(),
        'manager_user_id' => 1
    ];
});


$factory->define(App\Task::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word,
        'project_id' => $faker->numberBetween(1, 10),
        'roadmap_id' => $faker->numberBetween(1, 3),
        'exp_manager' => $faker->numberBetween(1, 3),
        'info_manager' => $faker->numberBetween(1, 3),
        'start' => \Carbon\Carbon::now(),
        'end'  => \Carbon\Carbon::now(),
    ];
});



$factory->define(App\Procedure::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->word
    ];
});



$factory->define(App\Result::class, function (Faker\Generator $faker) {

    return [
        'sample_id' => $faker->numberBetween(1, 3),
        'version'=> 1,
        'result' => json_encode($faker->sentences(20))
    ];
});
