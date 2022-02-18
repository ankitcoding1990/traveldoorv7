<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\SubAmenities;

$factory->define(SubAmenities::class, function (Faker $faker) {
    $subAmenities = [

        0 => [
            'amenities_id' => '1',
            'sub_amenities_name' => 'Shared lounge/TV area',
            'sub_amenities_created_by' => '1',

        ],
        1 => [
            'amenities_id' => '1',
            'sub_amenities_name' => 'Air conditioning',
            'sub_amenities_created_by' => '1',
        ],
        2 => [
            'amenities_id' => '2',
            'sub_amenities_name' => 'Airport drop off',
            'sub_amenities_created_by' => '1',
        ],
        3 => [
            'amenities_id' => '2',
            'sub_amenities_name' => 'Airport pick up',
            'sub_amenities_created_by' => '1',
        ],
        4 => [
            'amenities_id' => '3',
            'sub_amenities_name' => 'Terrace',
            'sub_amenities_created_by' => '1',
        ],

    ];
    // foreach ($subAmenities as $key => $val) {
    //     SubAmenities::factory()->updateOrCreate([
    //         'amenities_name' => $val['amenities_name']
    //     ], [
    //         'amenities_room_status' => $val['amenities_room_status'],
    //         'amenities_created_by' => $val['amenities_created_by']
    //     ]);
    // }
});
