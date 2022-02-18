<?php

namespace App\Repositories;

use App\Models\Activity;
use App\Models\ActivityBooking;
use App\Models\ActivityPricing;
use App\Models\ServiceImages;
use phpDocumentor\Reflection\Types\This;

class ActivityServicesRepository{

    public function __construct(Activity $activityModel, ActivityPricing $pricingModel, ActivityBooking $bookingModel,ServiceImages $imageModel)
    {
        $this->activityModel = $activityModel;
        $this->pricingModel = $pricingModel;
        $this->bookingModel = $bookingModel;
        $this->imageModel = $imageModel;
    }

    public function store($data)
    {
        try{
            $id = $this->activityModel->create($data)->id;
            $id = encrypt($id);
            return ['title' => 'Success','message' => 'Activity basic details has been stored', 'type' => 'success','redirect' => route('activity.prices.create',$id), 'id' => $id];
        }
        catch(\Exception $err){
            return ['title' => 'Failed','message' => 'Fail to store due to '.$err->getMessage(), 'type' => 'error'];
        }
    }

    public function DescriptionStore($data, $id)
    {
        try{
            $this->activityModel->where('id',$id)->update($data);
            return ['title' => 'Success','message' => 'Activity basic details has been stored', 'type' => 'success','redirect' => route('activities.index')];
        }
        catch(\Exception $err){
            return ['title' => 'Failed','message' => 'Fail to store due to '.$err->getMessage(), 'type' => 'error'];
        }
    }

    public function delete($id)
    {
        try{
            $this->activityModel->where('id',$id)->delete();
            return ['title' => 'Success','subject' => 'Activity service has been deleted','type' => 'success','table' => 'dataTable'];
        }
        catch(\Exception $err){
            return ['title' => 'Failed','subject' => 'Fail to delete due to '.$err->getMessage(), 'type' => 'error'];
        }
    }

    public function update($data, $id)
    {
       try{
            $this->activityModel->where('id',$id)->update($data);
            $pricings = ActivityPricing::where('activity_id',$id)->get()->pluck('id');
            $id = encrypt($id);
            $pricings = encrypt(json_encode($pricings));
            $message =  ['title' => 'Success','message' => 'Activity basic details has been updated', 'type' => 'success','redirect' => route('activity.prices.edit',[$id , $pricings]), 'id' => $id];
            return $message;
        }
        catch(\Exception $err){
            return ['title' => 'Failed','message' => 'Fail to update due to '.$err->getMessage(), 'type' => 'error'];
        }
    }

    public function changeState($id, $column, $bool)
    {
        try{
            if($this->activityModel->where('id',$id)->firstOrFail()->draft_status == 0){
                $this->activityModel->where('id', $id)->update([$column => $bool]);
                return ['title' => 'Success', 'subject' => $column.' just got '. $bool == 1 ? 'activated' : 'inactivated', 'type' => 'success'];
            }
            else{
                return ['title' => 'Error', 'subject' => 'Drafted activity '.$column.' can\'t be changed', 'type' => 'warning'];
            }
        }
        catch(\Exception $err){
            return ['title' => 'Failed' ,'subject' => 'Fail to '. $bool == 1 ? 'activated ' : 'inactivated '.$column. ' due to '.$err->getMessage(), 'type' => 'error'];
        }
    }

    public function clone($data)
    {
        try {
            $id = $this->activityModel->create($data['activity'])->id;
            foreach($data['pricings'] as $key => $pricings){
                $pricings['activity_id'] = $id;
                $this->pricingModel->create($pricings);
            }
            foreach($data['bookings'] as $key => $booking){
                $booking['activity_id'] = $id;
                $this->bookingModel->create($booking);
            }
            foreach($data['images'] as $key => $images){
                $images['activity_id'] = $id;
                $this->imageModel->create($images);
            }
            return ['title' => 'success', 'subject' => 'Copied! Check your draft', 'type' => 'success'];
        } catch (\Throwable $err) {
            return ['title' => 'Failed','subject' => 'Failed !'.$err->getMessage(), 'type' => 'error'];
        }
    }
}
