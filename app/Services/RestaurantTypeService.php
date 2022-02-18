<?php
namespace App\Services;

use App\RestaurantType;
use App\Repositories\RestaurantTypesRepository;

class RestaurantTypeService
{
    protected $restaurantTypeRepo;
    function __construct(RestaurantTypesRepository $restaurantTypeRepo){
        $this->restaurantTypeRepo = $restaurantTypeRepo;
    }

    function store($request){
        $data=$request->only('restaurant_type_name');
        if(auth()->check()){
            $data['restaurant_type_created_by']=auth()->user()->id;
        }
        $res=$this->restaurantTypeRepo->store($data);
        if($res){
            return['status' => true, 'message' => 'Successfully Inserted','title' => 'Success', 'type' => 'success'];
        }else{
            return['status' => false, 'message' => 'Unable to  Insert','title' => 'Error', 'type' => 'error'];
        }
        
    }
    function update($request){
        $data=$request->only('restaurant_type_name','id');
        $res=$this->restaurantTypeRepo->update($data);
        if($res){
            return ['status'=> true, 'message' => 'Successfully Updated','title' => 'Success', 'type' => 'success'];
        }else{
            return ['status' => false, 'message' => 'Unable to Update','title' => 'Error', 'type' => 'error'];
        }
    }
}
?>
