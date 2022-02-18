<?php

namespace App\Repositories;

use App\Models\HotelType;
use Exception;

class HotelTypeRepository{

    public function __construct(HotelType $model)
    {
        $this->model = $model;
    }
    public function update($data, $id)
    {
        try{
            $this->model->where('id',$id)->update($data);
            return ['title' => 'Success', 'message' => 'Hotel type updated!', 'type' => 'success', 'redirect' => route('hotel_type.index')];
        }
        catch (Exception $err){
            return ['title' => 'Success', 'message' => 'Failed! due to '. $err->getMessage(), 'type' => 'error'];
        }
    }

    public function insert($data)
    {
        try{
            $this->model->create($data);
            return ['title' => 'Success', 'message' => 'New hotel type added!', 'type' => 'success', 'table' => 'hoteltypedatatables-table'];
        }
        catch (Exception $err){
            return ['title' => 'Success', 'message' => 'Failed! due to '. $err->getMessage(), 'type' => 'error'];
        }
    }

    public function delete($id)
    {
        try{
            $this->model->where('id',$id)->delete();
            return ['title' => 'Success','subject' => 'Hotel type deleted!', 'type' => 'success'];
        }
        catch (Exception $err){
            return ['title' => 'Success', 'subject' => 'Failed! due to '. $err->getMessage(), 'type' => 'error'];
        }

    }
}
