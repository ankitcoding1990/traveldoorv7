<?php

namespace App\Repositories;

use App\Models\Cities;
use App\Models\SightSeeing;
use App\Models\AirportMaster;
use App\Models\TransferMaster;
use App\Models\BorderRailwayMaster;
use App\Models\SuggestedVehiclePrice;
use App\Models\SuggestedTransferPrice;
use Exception;

class VehicleSuggestedCostRepository{

    public function getTransfersByGet($country_id,$whereTransferType)
    {
        return TransferMaster::where('master_country',$country_id)->where('master_type',$whereTransferType)->get();
    }

    public function getTransfersByPluck($country_id,$transfer_type)
    {
        if($transfer_type == 'from-airport'){
            return AirportMaster::where('airport_master_country',$country_id)->pluck('airport_master_name','id');
        }
        else if($transfer_type == 'from-border'){
            return BorderRailwayMaster::where('master_country',$country_id)->where('master_type','border-master')->pluck('master_name','master_id');
        }
        else{
            return BorderRailwayMaster::where('master_country',$country_id)->where('master_type','railway-master')->pluck('master_name','master_id');
        }
    }

    public function getTransferCitiesByGet($country_id)
    {
       return Cities::join("states", "states.id", "=", "cities.state_id")
                ->where("states.country_id", $country_id)
                ->where("cities.city_status", 1)
                ->select("cities.*")->orderBy('cities.name', 'asc')->get();
    }

    public function getTransferCitiesByPluck($country_id)
    {
        return Cities::join("states", "states.id", "=", "cities.state_id")
                ->where("states.country_id", $country_id)
                ->where("cities.city_status", 1)
                ->select("cities.*")->orderBy('cities.name', 'asc')->pluck('name','id');
    }

    public function getCities($city_id)
    {
        return Cities::where('id', $city_id)->first();
    }

    public function getSightSeeing($cities,$country_id,$city_id)
    {
        if ($cities->name == "Tbilisi") {
            $sightSeeing = SightSeeing::where('sightseeing_country', $country_id)->where('sightseeing_status', 1)->get();
        } else if ($cities->name == "Kutaisi" || $cities->name == "Batumi") {
            $sightSeeing = SightSeeing::where('sightseeing_country', $country_id)->where(function ($query) use ($city_id) {
                $query->where('sightseeing_city_from', $city_id)->OrWhere('sightseeing_city_to', $city_id);
            })->where('sightseeing_status', 1)->get();
        } else {
            $sightSeeing = SightSeeing::where('sightseeing_country', $country_id)->where(function ($query) use ($city_id) {
                $query->where('sightseeing_city_from', $city_id)->where('sightseeing_city_to', $city_id);
            })->where('sightseeing_status', 1)->get();
        }
        return $sightSeeing;
    }

    public function sightSeeingInsert($data)
    {
        try{
            for ($cost_count = 0; $cost_count < count($data['tour_name']); $cost_count++) {
                if (!empty($tour_name[$cost_count])) {
                  $tour_id = $tour_name[$cost_count];
                  for ($i = 0; $i < count($data['tour_vehiclename'][($data['tour_name'][$cost_count] - 1)]); $i++) {
                    $get_suggested_cost = SuggestedVehiclePrice::where('tour_id', $tour_id)->where('vehicle_type_id', $data['tour_vehiclename'][($data['tour_name'][$cost_count] - 1)][$i])->first();
                    if ($get_suggested_cost) {
                      SuggestedVehiclePrice::where('tour_id', $tour_id)->where('vehicle_type_id', $data['tour_vehiclename'][($data['tour_name'][$cost_count] - 1)][$i])->update(['suggested_vehicle_cost' =>  $data['tour_suggested_cost'][($data['tour_name'][$cost_count] - 1)][$i]]);
                    } else {
                      SuggestedVehiclePrice::create(['tour_id' => $tour_id, 'vehicle_type_id' => $data['tour_vehiclename'][($data['tour_name'][$cost_count] - 1)][$i], 'suggested_vehicle_cost' =>  $data['tour_suggested_cost'][($data['tour_name'][$cost_count] - 1)][$i]]);
                    }
                  }
                }
            }
            return 1;
        }
        catch (Exception $err){
            return 0;
        }
    }

    public function transferInsert($data)
    {
        try{
            foreach ($data['transfer_to'] as $tranfer_value) {
                if (!empty($tranfer_value)) {
                    foreach ($data['transfer_vehiclename'][$tranfer_value] as $key => $value) {
                        $get_suggested_cost = SuggestedTransferPrice::where('transfer_type', $data['transfer_type'])
                        ->where('from_city_airport', $data['transfer_type_detail'])
                        ->where('to_city_airport', $tranfer_value)
                        ->where('transfer_vehicle_type_id', $value)
                        ->first();
                        if ($get_suggested_cost) {
                        SuggestedTransferPrice::where('transfer_type', $data['transfer_type'])
                            ->where('from_city_airport', $data['transfer_type_detail'])
                            ->where('to_city_airport', $tranfer_value)
                            ->where('transfer_vehicle_type_id', $value)
                            ->update(['suggested_transfer_vehicle_cost' =>  $data['transfer_suggested_cost'][$tranfer_value][$key]]);
                        // SuggestedTransferPrice::where('tour_id', $tour_id)->where('vehicle_type_id', $tour_vehiclename[($tour_name[$cost_count] - 1)][$i])->update(['suggested_vehicle_cost' =>  $tour_driver_cost[($tour_name[$cost_count] - 1)][$i]]);
                        } else {
                        SuggestedTransferPrice::create([
                            'transfer_type' => $data['transfer_type'],
                            'from_city_airport' => $data['transfer_type_detail'],
                            'to_city_airport' =>  $tranfer_value,
                            'transfer_vehicle_type_id' =>  $value,
                            'suggested_transfer_vehicle_cost' =>  $data['transfer_suggested_cost'][$tranfer_value][$key]
                            ]);
                        }
                    }
                }
            }
            return 1;
        }
        catch (Exception $err){
            return 0;
        }
    }
}
