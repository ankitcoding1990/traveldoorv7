<?php

use App\Models\FuelType;
use Illuminate\Database\Seeder;

class FuelTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $FuelType = [
            [
                'fuel_type'    =>  'EURO REGULAR',
                'fuel_type_cost' =>  '3.5',
                'created_by'   =>  '1',
             
            ],
            [
                'fuel_type'    =>  'EURO DIESEL',
                'fuel_type_cost' =>  '4.5',
                'created_by'   =>  '1',
             
            ],
            ];
            foreach($FuelType as $val){
                FuelType::updateOrCreate(['fuel_type' => $val['fuel_type'], 'fuel_type_cost' =>$val['fuel_type_cost'], 'created_by' =>$val['created_by']]);
            
            }
     }
    
}
