<?php

namespace App\Services;

use App\Repositories\VehicleSuggestedCostRepository;

class VehicleSuggestedCostService{

    public function __construct(VehicleSuggestedCostRepository $repo)
    {
        $this->repo = $repo;
    }

    public function getTransferMasterByPluck($transfer_type,$country_id)
    {
        if($transfer_type == 'from-airport' || $transfer_type == 'from-border' || $transfer_type == 'from-railway'){
            $data = $this->repo->getTransfersByPluck($country_id,$transfer_type);
        }
        else{
            $data = $this->repo->getTransferCitiesByPluck($country_id);
        }
        return $data;
    }

    public function getTransferMasterByGet($transfer_type,$country_id)
    {
        if($transfer_type == 'to-airport'){
            $whereTransferType = 'airport-master';
        }
        else if($transfer_type == 'to-border'){
            $whereTransferType = 'border-master';
        }
        else if($transfer_type == 'to-railway'){
            $whereTransferType = 'railway-master';

        }
        if(isset($whereTransferType)){
            $data = $this->repo->getTransfersByGet($country_id,$whereTransferType);
        }else{
            $data = $this->repo->getTransferCitiesByGet($country_id);
        }

        return $data;
    }

    public function getSightSeeing($city_id,$country_id)
    {
        $cities = $this->repo->getCities($city_id);
        return $this->repo->getSightSeeing($cities,$country_id,$city_id);
    }

    public function store($request)
    {
        if($request->suggested_price_for == 'sightseeing'){
            $data = $request->only('tour_name','tour_vehiclename','tour_suggested_cost');
            $res = $this->repo->sightSeeingInsert($data);
            if($res){
                return ['SightSeeing Updated Successfully!','success'];
            }
            else{
                return ['Fail to Update SightSeeing','error'];
            }
        }else if($request->suggested_price_for == 'transfer'){
            $data = $request->only('transfer_type','driver_country','transfer_type_detail','transfer_vehiclename','transfer_suggested_cost','transfer_to');
            $res = $this->repo->transferInsert($data);
            if($res){
                return ['Transfers Updated Successfully!','success'];
            }
            else{
                return ['Fail to Update Transfers','error'];
            }
        }
    }
}
