<?php

namespace App\Services;

use App\Repositories\SuggestedGuideCostRepository;


class SuggestedGuideCostService {
    public function __construct(SuggestedGuideCostRepository $repo)
    {
        $this->repo = $repo;
    }

    public function store($request)
    {
        if ($request->has('tour_name')) {
            $data = $request->only('tour_name','tour_vehiclename','tour_suggested_cost');
            $result  = $this->repo->insert($data);
        }
        if ($request->has('airport_name')) {
            $data = $request->only('tour_name','airport_name','airport_vehicle_name','airport_guide_suggested_outside_cost','airport_guide_suggested_inside_cost');
            $result1 = $this->repo->insert1($data);
        }
            if($request->has('tour_name') && $request->has('airport_name')) {
                if($result == 1 && $result1 == 1) {
                    return ['Service Management Updated Successfully', 'success'];
                } else {
                    return ['Unable to Update Service Management', 'error1'];
                }
            } else if($request->has('tour_name') && !$request->has('airport_name')) {
                if($result == 1) {
                    return ['Service Management Updated Successfully', 'success'];
                } else {
                    return ['Unable to Update Service Management', 'error2'];
                }
            } else if(!$request->has('tour_name') && $request->has('airport_name')) {
                if($result1 == 1) {
                    return ['Service Management Updated Successfully', 'success'];
                } else {
                    return ['Unable to Update Service Management', 'error2'];
                }
            }
    }
}
