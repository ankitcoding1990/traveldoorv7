<?php

namespace App\Services;
use App\Models\Restaurants;
use App\Traits\MyUpload;
use App\Repositories\RestaurantManagementRepository;

class RestaurantManagementService{
    use MyUpload;
    public function __construct(RestaurantManagementRepository $restaurantManagementRepo){
    $this->restaurantManagementRepo = $restaurantManagementRepo;
    }

    public function store($request,$id=null){
        $data=$request->except(['_method','_token']);
        $data['valid_from_time']=date("H:i", strtotime($data['valid_from_time']));
        $data['valid_to_time']=date("H:i", strtotime($data['valid_to_time']));
        if(!isset($data['available_for_delivery'])){
            $data['available_for_delivery']=0;
        }else{
            $data['available_for_delivery']=(int)$data['available_for_delivery'];
        }

        if($id==null){
            if(auth()->check() && auth()->user()->isAdmin()){
                $data['approve_status']=1;
                $data['created_user_id']=auth()->user()->id;
                $redirect_route='restaurant.images.create';
            }else if(auth()->guard('supplier')->check()){
                $data['created_supplier_id']=auth()->guard('supplier')->user()->id;
                $redirect_route='supplier.restaurant.images.create';
            }
            
            $result=$this->restaurantManagementRepo->store($data);
            if($result['status']){
                return ['redirect'=>route($redirect_route,['id'=> $result['response']]), 'message' => 'Restaurant Created Successfully!', 'type' => 'success', 'title' => 'Success'];
            }else{
                ['message' => $result['response'], 'type' => 'error', 'title' => 'Error'];
            }
        }else{
            if(auth()->check() && auth()->user()->isAdmin()){
                $redirect_route='restaurant.images.edit';
            }else if(auth()->guard('supplier')->check()){
                $redirect_route='supplier.restaurant.images.edit';
            }
            $result= $this->restaurantManagementRepo->update($data,$id);
            if($result['status']){
                return ['redirect'=>route($redirect_route,['id'=> $id]), 'message' => 'Restaurant Updated Successfully!', 'type' => 'success', 'title' => 'Success'];
            }else{
                return ['message' => $result['response'], 'type' => 'error', 'title' => 'Error'];
            }
        }
    }

    public function updateDrafted($id)
    {
        if(auth()->check() && auth()->user()->isAdmin()){
            $redirect_route='restaurants.index';
        }else if(auth()->guard('supplier')->check()){
            $redirect_route='restaurant.index';
        }
        $data['drafted_status']=0;
        $result= $this->restaurantManagementRepo->updateDrafted($data,$id);
        if($result['status']){
            return ['redirect'=>route($redirect_route), 'message' => 'Restaurant Created Successfully!', 'type' => 'success', 'title' => 'Success',];
        }else{
            return ['message' => $result['response'], 'type' => 'error', 'title' => 'Error'];
        }
    }

    public function changeStatus($id, $column, $bool)
    {
        return $this->restaurantManagementRepo->changeStatus($id, $column, $bool);
    }
}


?>
