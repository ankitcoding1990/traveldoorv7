<?php
namespace App\Repositories;

use Exception;
use App\Models\Amenities;
use App\Models\SubAmenities;

class SubAmenitiesRespository {
    public function __construct(SubAmenities $model)
    {
        $this->model = $model;
    }

    public function update($data, $id)
    {
        try {
            $this->model->where('id',$id)->update($data);
            return ['title' => 'Success', 'message' => 'Sub amenity updated', 'type' => 'success', 'redirect' => route('sub_amenities.index')];
        }
        catch (Exception $err) {
            return ['title' => 'Failed', 'message' => 'Failed! due to'. $err->getMessage(), 'type' => 'error'];
        }
    }

    public function insert($data)
    {
        try{
            $this->model->create($data);
            return ['title' => 'Success', 'message' => 'New sub amenity added', 'type' => 'success', 'table' => 'subamenitiesdatatables-table'];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'message' => 'Failed! due to'. $err->getMessage(), 'type' => 'error'];
        }
    }
    public function delete($id)
    {
        try{
            $this->model->where('id',$id)->delete();
            return ['title' => 'Success','subject' => 'Sub amenity deleted','type' => 'success'];
        }
        catch(Exception $err){
            return ['title' => 'Failed', 'subject' => 'Failed! due to'. $err->getMessage(), 'type' => 'error'];
        }
    }
    public function statechanger($id, $status)
    {
        try{
            $bool = $status == 'active' ? '1' : '0';
            $this->model->where('id',$id)->update(['sub_amenities_status' => $bool]);
            return ['title' => 'Success', 'subject' => 'Sub amenity '.$status.'d', 'type' => 'success'];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'subject' => 'Failed! due to '.$err->getMessage(), 'type' => 'error'];
        }
    }
}
