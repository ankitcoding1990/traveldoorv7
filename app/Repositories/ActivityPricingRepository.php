<?php

namespace App\Repositories;

use App\Models\ActivityBooking;
use App\Models\ActivityPricing;

class ActivityPricingRepository
{
    public function __construct(ActivityPricing $model)
    {
        $this->model = $model;
    }

    public function store($data, $id)
    {
        try{
            foreach($data as $key => $value){
                $this->model->create($value);
            }
            $id = encrypt($id);
            return ['title' => 'Success','message' => 'Activity pricing has been added', 'type' => 'success', 'redirect' => route('activity.booking.create',$id), 'id' => $id];
        }
        catch (\Exception $err){
            return ['title' => 'Failed','message' => 'fail to add pricing for that activity due to '. $err->getMessage(), 'type' => 'error'];
        }
    }

    public function update($data, $activity_id)
    {
        try{
            foreach($data as $key => $value){
                $this->model->where('activity_id',$activity_id)->updateOrCreate([
                    'id' => $value['id']
                ],$value);
            }
            $bookings = ActivityBooking::where('activity_id',$activity_id)->get()->pluck('id');
            $id = encrypt($activity_id);
            $booking_ids = encrypt(json_encode($bookings, true));
            $message =  ['title' => 'Success','message' => 'Activity pricing has been updated', 'type' => 'success', 'redirect' => route('activity.booking.edit',[$id, $booking_ids]),'id' => $id];
            return $message;
        }
        catch(\Exception $err){
            return ['title' => 'Failed','message' => 'fail to update pricing for that activity due to '. $err->getMessage(), 'type' => 'error'];
        }

    }

    public function delete($pricing_id)
    {
        try{
            $this->model->where('id',$pricing_id)->delete();
            return ['title' => 'Deleted','message' => 'Activity pricing has been deleted', 'type' => 'success'];
        }
        catch(\Exception $err){
            return ['title' => 'Failed','message' => 'Error: '.$err->getMessage(), 'type' => 'error'];
        }
    }
}
