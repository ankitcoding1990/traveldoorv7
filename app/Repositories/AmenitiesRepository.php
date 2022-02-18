<?php

namespace App\Repositories;

use App\Models\Amenities;
use Exception;

class AmenitiesRepository{
    public function __construct(Amenities $model)
    {
        $this->model = $model;
    }
    public function update($data, $id)
    {
        try{
            $this->model->where('id',$id)->update($data);
            return ['title' => 'Success','message' => 'Amenity updated!', 'type' => 'success','redirect' => route('amenities.index')];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'message' => 'Failed! due to '.$err->getMessage(), 'type' => 'error'];
        }
    }
    public function insert($data)
    {
        try{
            $this->model->create($data);
            return ['title' => 'Success','message' => 'New amenity added!', 'type' => 'success','table' => 'amenitiesdatatables-table'];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'message' => 'Failed! due to '.$err->getMessage(), 'type' => 'error'];
        }
    }

    public function delete($id)
    {
        try{
            $this->model->where('id',$id)->delete();
            return ['title' => 'Success', 'subject' => 'Amenity deleted', 'type' => 'success'];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'subject' => 'Failed! due to '.$err->getMessage(), 'type' => 'error'];

        }
    }

    public function statechanger($id, $status)
    {
        try{
            $bool = $status == 'active' ? '1' : '0';
            $this->model->where('id',$id)->update(['amenities_status' => $bool]);
            return ['title' => 'Success', 'subject' => 'Amenity '.$status.'d', 'type' => 'success'];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'subject' => 'Failed! due to '.$err->getMessage(), 'type' => 'error'];
        }
    }
}
