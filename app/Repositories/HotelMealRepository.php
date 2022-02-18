<?php
namespace App\Repositories;

use App\Models\HotelMeal;
use Exception;

class HotelMealRepository{

    public function __construct(HotelMeal $model)
    {
        $this->model = $model;
    }

    public function update($data, $id)
    {
        try{
            $this->model->where('id',$id)->update($data);
            return ['title' => 'Success', 'message' => 'Hotel meal got updated','type' => 'success', 'redirect' => route('hotelmeal.index')];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'message' => 'Failed! due to '. $err->getMessage(), 'type' => 'error'];
        }
    }

    public function insert($data)
    {
        try{
            $this->model->create($data);
            return ['title' => 'Success', 'message' => 'New hotel meal got added','type' => 'success','table' => 'hotelmealsdatatables-table'];
        }
        catch (Exception $err){
            return ['title' => 'Failed', 'message' => 'Failed! due to '. $err->getMessage(), 'type' => 'error'];
        }
    }

    public function ChangeState($id, $state)
    {
        try {
            $bool = $state == 'active' ? '1' : '0';
            $this->model->where('id',$id)->update(['hotel_meals_status' => $bool]);
            return ['title' => 'Success','subject' => 'Hotel meal '.$state.'d','type' => 'success'];
        } catch (\Throwable $err) {
            return ['title' => 'Failed', 'subject' => 'Failed! due to '.$err->getMessage(),'type' => 'error'];
        }
    }

    public function delete($id)
    {
        try {
            $this->model->where('id', $id)->delete();
            return ['title' => 'Success', 'subject' => 'Hotel meal deleted!','type' => 'success'];
        } catch (\Throwable $err) {
            return ['title' => 'Failed', 'subject' => 'Failed! due to '.$err->getMessage(),'type' => 'error'];
        }
    }
}
