<?php
namespace App\Services;
use App\Repositories\RestaurantMenuRepository;

class RestaurantMenuService{
    public function __construct(RestaurantMenuRepository $restaurantMenuRepo)
    {
        $this->restaurantMenuRepo = $restaurantMenuRepo;
    }

    public function store($request){
        $data=$request->only('name','description','created_by');
        $res=$this->restaurantMenuRepo->store($data);
        if($res){
            return ['status' => true, 'message' => 'The Menu Category Inserted Successfully'];
        }else{
            return ['status' => false, 'message' => 'Unable to Insert Menu Category'];
        }
    }

    public function update($request, $id){
        $data=$request->only('name','description','created_by');
        $res=$this->restaurantMenuRepo->update($data,$id);
        if($res){
            return ['status' => true, 'message' => 'Successfully Updated','title' => 'Success' ,'type' => 'success'];
        }else{
            return ['status' => false, 'message' => 'Unable to Insert','title' => 'Error' ,'type' => 'error'];
        }
    }
}

?>

