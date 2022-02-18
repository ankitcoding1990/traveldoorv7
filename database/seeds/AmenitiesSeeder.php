<?php

use App\Models\Amenities;
use App\Models\SubAmenities;
use Illuminate\Database\Seeder;

class AmenitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $amenities = [
            1 => [
                'amenities_name' => 'General',
                'amenities_room_status' => '1',
                'amenities_created_by' => '1',
                'subamenities' => [
                    [
                        'sub_amenities_name' => 'Shared lounge/TV area',
                        'sub_amenities_created_by' => '1',

                    ],
                    'subamenities' => [
                        'sub_amenities_name' => 'Air conditioning',
                        'sub_amenities_created_by' => '1',
                    ],
                ]
            ],
            2 => [
                'amenities_name' => 'Transport',
                'amenities_room_status' => '1',
                'amenities_created_by' => '1',
                'subamenities' => [
                    [
                        'sub_amenities_name' => 'Airport drop off',
                        'sub_amenities_created_by' => '1',
                    ],
                        'subamenities' => [
                        'sub_amenities_name' => 'Airport pick up',
                        'sub_amenities_created_by' => '1',
                    ],
                ]
            ],
            3 => [
                'amenities_name' => 'Outdoors',
                'amenities_room_status' => '1',
                'amenities_created_by' => '1',
                'subamenities' => [
                    [
                        'sub_amenities_name' => 'Terrace',
                        'sub_amenities_created_by' => '1',
                    ],
                ]
            ]
        ];
        foreach ($amenities as $key => $val) {

            Amenities::updateOrCreate([
                'amenities_name' => $val['amenities_name']
            ], [
                'amenities_room_status' => $val['amenities_room_status'],
                'amenities_created_by' => $val['amenities_created_by']
            ]);
            foreach ($val['subamenities'] as $value) {
                SubAmenities::updateOrCreate([
                    'sub_amenities_name' => $value['sub_amenities_name']
                ], [
                    'amenities_id' => $key,
                    'sub_amenities_created_by' => $value['sub_amenities_created_by'],
                ]);
            }
        }
    }
}
