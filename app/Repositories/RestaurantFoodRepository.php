<?php
namespace App\Repositories;
use App\Models\RestaurantFood;
use App\Models\RestaurantFood_log;
use App\Models\Restaurants;
use Exception;

class RestaurantFoodRepository{
    protected $restaurantfood;
    public function __construct(RestaurantFood $RestaurantFoodRepository, RestaurantFood_log $RestaurantFoodLogRepository){
        $this->RestaurantFoodRepository = $RestaurantFoodRepository;
        $this->RestaurantFoodLogRepository = $RestaurantFoodLogRepository;
    }

    public function store($data){
        $food_name = $data['food_name'];
        if(RestaurantFood::where('food_name',$food_name)->first()){
            return ['status' => 'exists', 'message' => 'Food / Drinks already exists', 'type' => 'warning', 'title' => 'Warning'];
        }else{
            try{
                    if($res = $this->RestaurantFoodRepository->create($data)){
                        $log_data = $res->toArray();
                        $log_data['food_operation_performed']   =  "INSERT";
                        $log_data['restaurant_food_id']    = $log_data['id'];
                        $res = RestaurantFood_log::create($log_data);
                    }
                    return ['status' => true, 'message' => 'Food / Drinks Created Successfully !', 'type' => 'success', 'title' => 'Success'];

            }catch(Exception $e){
                    return ['status' => false, 'message' => 'Food / Drinks cannot be inserted right now! ', 'type' => 'error', 'title' => 'Error'];

            }
        }

    }
    public function update($data ,$id){
            try{
                RestaurantFood::where('restaurant_food_id', $id)->update($data);
                return ['status' => true , 'message' => 'Food-Drinks Updated Successfully !', 'type' => 'success' ,'title' => 'Success', 'restaurant' => RestaurantFood::where('restaurant_food_id',$id)->first()];
            }catch(Exception $e){
                return ['status' => false , 'message' =>$e, 'type' => 'error' ,'title' => 'Error'];
            }
    }

    public function createRestaurantLogs($data_log)
    {
        try {
            RestaurantFood_log::create($data_log);
            return['status' => true, 'message' => 'Log Updated'];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}
?>
