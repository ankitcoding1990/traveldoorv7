<?php
namespace App\Repositories;

use App\Models\Sightseeing;

Class SightseeingManagementRepository
{
    public function __construct(SightSeeing $model)
    {
        $this->model = $model;
    }
    public function updateStore($data, $id=null){
      try {
        $data = $this->model->updateOrCreate(['id' => $id],$data);
       $id = encrypt($data->id);
        if($data){
            return ['title' => 'Success','message' => 'Next add group pricing', 'type' => 'success','redirect' => route('sightseeings.prices.create',$id), 'id' => $id];
        }
      } catch (\Exception $e) {
        return ['title' => 'Failed', 'message' => 'Failed to store the Sightseeing Management due to '. $e->getMessage(), 'type' => 'error'];

      }
    }
    public function updatePricing($data, $id){
      //dd($data, $id);
      try {
        $data = $this->model->where('id', $id)->update($data);
       $id = encrypt($id);
        if($data){
            return ['title' => 'Success','message' => 'Next add sightseeing images', 'type' => 'success','redirect' => route('sightseeings.images.upload', $id), 'id' => $id];
        }
      } catch (\Exception $e) {
        return ['title' => 'Failed', 'message' => 'Failed to store the Sightseeing Management due to '. $e->getMessage(), 'type' => 'error'];

      }
    }
    public function updateDescription($data, $id){
      try {
        $data = $this->model->where('id',$id)->update($data);
        if($data){
            return ['title' => 'Success','message' => 'Sightseeing services added successfully', 'type' => 'success','redirect' => route('sightseeings.index')];
        }
      } catch (\Exception $e) {
        return ['title' => 'Failed', 'message' => 'Failed to store the Sightseeing Management due to '. $e->getMessage(), 'type' => 'error'];

      }
    }
    public function publish($data, $id=null){
      try {
        $data = $this->model->where('id',$id)->update($data);
        if($data){
          return ['title' => 'Success','message' => 'Sightseeing details has been stored & publish', 'type' => 'success','redirect' => route('sightseeings.index'), 'id' => $id];

        }
      } catch (\Exception $e) {
        return ['title' => 'Failed', 'message' => 'Failed to store the Sightseeing Management due to '. $e->getMessage(), 'type' => 'error'];

      }
    }
    public function changeState($id, $column, $bool)
    {
      //dd($column);
        try{
            if($this->model->where('id',$id)->firstOrFail()){
               $data =  $this->model->where('id', $id)->update([$column => $bool]);
             if($column == 'admin_approval'){
              $status = 'Pending';
               if($bool==1){
                $status = 'Approved';
               }else if($bool==2){
                 $status = 'Blocked';
               }
              }else{
                $status = 'Inactive';
                if($bool==1){
                 $status = 'Active';
                }
              }
                return ['title' => 'Success', 'subject' => $status, 'type' => 'success'];
            }
          // return ['title' => 'Error', 'subject' => 'Not Found '.$column.' ', 'type' => 'warning'];

        }
        catch(\Exception $err){
            return ['title' => 'Failed' ,'subject' => 'Fail to '. $bool == 1 ? 'activated ' : 'inactivated '.$column. ' due to '.$err->getMessage(), 'type' => 'error'];
        }
    }
    public function delete($id)
    {
        try{
            $this->model->where('id',$id)->delete();
            return ['title' => 'Success', 'subject' => 'Sightseeing services delete successfully', 'type' => 'success'];
        }
        catch(\Exception $err){
            return ['title' => 'Failed',  'subject' => 'Error Occurred..! Please Try Again', 'type' => 'error'];
        }
    }
}
