<?php

namespace App\Repositories;

use Exception;
use App\Models\Services;
use App\Models\SuggestedAirportPrice;
use App\Models\SuggestedVehiclePrice;

class SuggestedGuideCostRepository{

    public function __construct(SuggestedVehiclePrice $model)
    {
        $this->model = $model;
    }
    public function insert($data)
    {
        try{
            for ($cost_count = 0; $cost_count < count($data['tour_name']); $cost_count++) {
                if (!empty($tour_name[$cost_count])) {
                  $tour_id = $tour_name[$cost_count];
                  for ($i = 0; $i < count($data['tour_vehiclename'][($tour_name[$cost_count] - 1)]); $i++) {
                    $get_suggested_cost = $this->model->where('tour_id', $tour_id)->where('vehicle_type_id', $data['tour_vehiclename'][($tour_name[$cost_count] - 1)][$i])->first();
                    if ($get_suggested_cost) {
                      $this->model->where('tour_id', $tour_id)->where('vehicle_type_id', $data['tour_vehiclename'][($tour_name[$cost_count] - 1)][$i])->update(['suggested_guide_cost' =>  $data['tour_guide_cost'][($tour_name[$cost_count] - 1)][$i]]);
                    } else {
                      $this->model->create(['tour_id' => $tour_id, 'vehicle_type_id' => $data['tour_vehiclename'][($tour_name[$cost_count] - 1)][$i], 'suggested_guide_cost' =>  $data['tour_guide_cost'][($tour_name[$cost_count] - 1)][$i]]);
                    }
                  }
                }
              }
            return 1;
        }
        catch (Exception $err){
            // dd($err->getMessage());
            return 0;
        }
    }

    public function insert1($data)
    {
        try{
            for ($airport_cost_count = 0; $airport_cost_count < count($data['airport_name']); $airport_cost_count++) {
                if (!empty($tour_name[$airport_cost_count])) {
                  $airport_id = $data['airport_name'][$airport_cost_count];
                  for ($i = 0; $i < count($data['airport_vehicle_name'][($data['airport_name'][$airport_cost_count] - 1)]); $i++) {
                    $get_suggested_cost = $this->model->where('airport_id', $airport_id)->where('vehicle_type_id', $data['airport_vehicle_name'][($data['airport_name'][$airport_cost_count] - 1)][$i])->first();
                    if ($get_suggested_cost) {
                      $this->model->where('airport_id', $airport_id)->where('vehicle_type_id', $data['airport_vehicle_name'][($data['airport_name'][$airport_cost_count] - 1)][$i])->update(['guide_suggested_inside_city_cost' =>  $data['airport_guide_suggested_inside_cost'][($data['airport_name'][$airport_cost_count] - 1)][$i], 'guide_suggested_outside_city_cost' =>  $data['airport_guide_suggested_outside_cost'][($data['airport_name'][$airport_cost_count] - 1)][$i]]);
                    } else {
                      $this->model->create(['airport_id' => $airport_id, 'vehicle_type_id' => $data['airport_vehicle_name'][($data['airport_name'][$airport_cost_count] - 1)][$i], 'guide_suggested_inside_city_cost' =>  $data['airport_guide_suggested_inside_cost'][($data['airport_name'][$airport_cost_count] - 1)][$i], 'guide_suggested_outside_city_cost' =>  $data['airport_guide_suggested_outside_cost'][($data['airport_name'][$airport_cost_count] - 1)][$i]]);
                    }
                  }
                }
            }
            return 1;
        }
        catch (Exception $err){
            // dd($err->getMessage());
            return 0;
        }
    }



}
