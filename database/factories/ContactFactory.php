<?php
/**
 * Created by PhpStorm.
 * User: ntimobedyeboah
 * Date: 2/4/17
 * Time: 10:25 PM
 */
use App\Contact;
use App\User;

$factory->define(Contact::class, function(Faker\Generator $faker) {
    return [
        'title' => 'Mrs.',
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'gender' => 'Female',
        'email' => $faker->safeEmail,
        'contact_number' => $faker->phoneNumber,
        'address' => $faker->address,
        'owner_id' => factory(User::class)->create()->id
    ];
});