<?php

use Illuminate\Database\Seeder;
use App\Models\OurService;

class OurServicesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
          [
            'name'  =>  'Hotel',
            'slug'  =>  'hotel',
            'image' =>  ''
          ],
          [
            'name'  =>  'Activity',
            'slug'  =>  'activity',
          ],
          [
            'name'  =>  'Guide',
            'slug'  =>  'guide',
          ],
          [
            'name'  =>  'Sightseeing',
            'slug'  =>  'sightseeing',
          ],
          [
            'name'  =>  'Itinerary',
            'slug'  =>  'itinerary',
          ],
          [
            'name'  =>  'Transfer',
            'slug'  =>  'transfer',
          ],
          [
            'name'  =>  'Restaurant',
            'slug'  =>  'restaurant',
          ],

        ];

        foreach ($services as $key => $service) {
          // update or create service
          OurService::updateOrCreate(['slug' => $service['slug']], ['name' => $service['name']]);
        }

    }
}
