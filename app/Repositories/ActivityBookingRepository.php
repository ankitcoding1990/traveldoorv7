<?php

namespace App\Repositories;

use App\Models\ActivityBooking;

class ActivityBookingRepository{
    public function __construct(ActivityBooking $model)
    {
        $this->model = $model;
    }

    public function store($data, $id)
    {
        try{
            foreach($data as $key => $value){
                $value['activity_id'] = $id;
                $this->model->create($value);
            }
            $id = encrypt($id);
            return ['title' => 'Success','message' => 'Activity booking has been added','type' => 'success','redirect' => route('activity-img-upload',['id' => $id]), 'id' => $id];
        }
        catch(\Exception $err){
            return ['title' => 'Failed', 'message' => 'Failed to store the activity booking due to '. $err->getMessage(), 'type' => 'error'];
        }
    }

    public function update($data, $id)
    {
        try{
            foreach($data as $key => $value){
                $value['activity_id'] = $id;
                $this->model->where('activity_id',$id)->updateOrCreate([
                    'id' => $value['id']
                ],$value);
            }
            $id = encrypt($id);
            return ['title' => 'Success','message' => 'Activity booking has been updated','type' => 'success','redirect' => route('activity-img-edit',['id' => $id]),'id' => $id];
        }
        catch(\Exception $err){
            return ['title' => 'Failed', 'message' => 'Failed to update the activity booking due to '. $err->getMessage(), 'type' => 'error'];
        }
    }

    public function delete($booking_id)
    {
        try{
            $this->model->where('id',$booking_id)->delete();
            return ['title' => 'Deleted','message' => 'Booking session has been deleted', 'type' => 'success'];
        }
        catch(\Exception $err){
            return ['title' => 'Failed','message' => 'Fail to delete booking session', 'type' => 'error'];
        }
    }
}
