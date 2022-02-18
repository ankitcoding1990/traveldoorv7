<?php

namespace App\Services;

use App\Models\Activity;
use App\Repositories\ActivityServicesRepository;

class ActivityServicesService{

    public function __construct(ActivityServicesRepository $repo)
    {
        $this->repo = $repo;
    }

    public function store($request, $id = null)
    {
        $data = $request->only('activity_type_id','name','supplier_id','location','country_id','city_id','duration','valid_from','valid_to','time_from','time_to','currency','blackout_days','booking_type','age_groups','activity_available_days','created_supplier_id','created_user_id');
        $data['age_groups']['adult']['allowed'] = $data['age_groups']['adult']['allowed']  ?? 'No' ;
        $data['age_groups']['child']['allowed'] = $data['age_groups']['child']['allowed'] ?? 'No' ;
        $data['age_groups']['infant']['allowed'] = $data['age_groups']['infant']['allowed'] ?? 'No' ;
        if(auth()->check()){
            $data['approve_status'] = 1;
        }
        $data['time_from']= date("H:i:s", strtotime($data['time_from']));
        $data['time_to']= date("H:i:s", strtotime($data['time_to']));
        if($id != null){
            return $this->repo->update($data, $id);
        }
        return $this->repo->store($data);
    }

    public function DescriptionStore($request)
    {
        $data = $request->only('inclusions','exclusions','description','cancel_policy','terms_conditions','confirm_message');
        $data['status'] = 1;
        $data['draft_status'] = 0;
        $id = $request->activity_id;
        return $this->repo->DescriptionStore($data,$id);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }

    public function changeState($id, $column, $bool)
    {
        return $this->repo->changeState($id, $column, $bool);
    }

    public function clone($id)
    {
        $data = $this->PrepareClone($id);
        return $this->repo->clone($data);

    }

    public function PrepareClone($id)
    {
        $activity = Activity::find($id);
        $pricings = $activity->pricings;
        $bookings = $activity->booking;
        $images = $activity->images;
        $activity->is_cloned = date('Y-m-d H:m:s');
        $activity->draft_status = 1;
        $activity->status = 0;
        if(auth()->check()){
            $activity->created_user_id = auth()->id();
            $activity->created_supplier_id = null;
        }
        if(auth()->guard('supplier')->check()){
            $activity->created_user_id = null;
            $activity->created_supplier_id = auth()->guard('supplier')->check();
        }
        $activity->id = null;
        $activity->created_at = null;
        $activity->updated_at = null;
        foreach($pricings as $key => $prices){
            $pricings[$key]['id'] = null;
            $pricings[$key]['created_at'] = null;
            $pricings[$key]['updated_at'] = null;
        }
        foreach($bookings as $key => $value){
            $bookings[$key]['id'] = null;
            $bookings[$key]['created_at'] = null;
            $bookings[$key]['updated_at'] = null;
        }
        foreach($images as $key => $image){
            $images[$key]['id'] = null;
            $images[$key]['created_at'] = null;
            $images[$key]['updated_at'] = null;
        }

        return ['activity' => $activity->toArray(), 'pricings' => $pricings->toArray(),'bookings' => $bookings->toArray(), 'images' => $images->toArray()];
    }
}
