<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Amenities;

$factory->define(Amenities::class, function (Faker $faker) {
    $amenities = [
        0 => [
            'amenities_name' => 'General',
            'amenities_room_status' => '1',
            'amenities_created_by' => '1',
        ],
        1 => [
            'amenities_name' => 'Transport',
            'amenities_room_status' => '1',
            'amenities_created_by' => '1',
        ],
        2 => [
            'amenities_name' => 'Outdoors',
            'amenities_room_status' => '1',
            'amenities_created_by' => '1',
        ]
    ];
    // foreach ($amenities as $key => $val) {
    //     Amenities::factory()->updateOrCreate([
    //         'amenities_name' => $val['amenities_name']
    //     ], [
    //         'amenities_room_status' => $val['amenities_room_status'],
    //         'amenities_created_by' => $val['amenities_created_by']
    //     ]);
    // }
});
