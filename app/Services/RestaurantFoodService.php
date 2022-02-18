<?php

namespace App\Services;
use App\Models\Restaurants;
use App\Models\RestaurantFood;
use App\Traits\MyUpload;
use App\Models\RestaurantMenuCategory;
use App\Repositories\RestaurantFoodRepository;



class RestaurantFoodService{
    use MyUpload;

    protected $restaurantFoodRepo;
    public function __construct(RestaurantFoodRepository $restaurantFoodRepo){
        $this->restaurantFoodRepo = $restaurantFoodRepo;
    }

    public function store($request){
        $food_role = $request->get('food_role');
        if ($food_role == 'supplier') {
            $user_id = $request->get('supplier_name');
            $user_role = 'Supplier';
        } else {
            if (session()->get('travel_users_role') == "Admin") {
            $user_role = 'Admin';
            } else {
            $user_role = 'Sub-User';
            }
            $user_id = session()->has('travel_users_id');
        }

        // multi file uploading

        $files_name = array();
        if ($request->hasFile('upload_ativity_images')) {
            $file_array = $request->file('upload_ativity_images');
            $dir1 = 'assets/uploads/food_images/';
            $files_name = self::multipleFile($file_array,$dir1);

        }
        $files_name = serialize($files_name);
        if ($user_role == "Admin") {
            $data['food_approval_status'] = 0;
        }
        $data = $request->only('food_created_by','restaurant_id_fk','menu_category_id_fk','food_name',
                                'food_price','food_discounted_price','food_unit','food_package_count','food_available_for_delivery','food_type',
                                'food_ingredients','food_featured');
        $data['food_images'] = $files_name;
        $data['food_role']   = $user_role;
        return $res = $this->restaurantFoodRepo->store($data);
        }



    public function update($request ,$id){
        $user_role = $request->food_role;
        if (!empty($request->upload_ativity_already_images)) {
                $old_images = $request->upload_ativity_already_images;
            } else {
                $old_images = array();
            }
            // dd($old_images);
        $new_images = array();
        if ($request->hasFile('upload_ativity_images')) {
            $file_array = $request->upload_ativity_images;
            $dir1 = 'assets/uploads/food_images/';
            $new_images = self::multipleFile($file_array,$dir1);
        }

        $files_name = serialize(array_merge($new_images, $old_images));
        $data = $request->only('food_created_by','restaurant_id_fk','menu_category_id_fk','food_name',
                                'food_price','food_discounted_price','food_unit','food_package_count','food_available_for_delivery','food_type',
                                'food_featured','food_ingredients');
        $data['food_images']  = $files_name;
        $data['food_role']    = $user_role;

        // $log_data = $request->only('food_created_by','restaurant_id_fk','menu_category_id_fk','food_name',
        //                     'food_price','food_discounted_price','food_unit','food_package_count','food_available_for_delivery','food_type',
        //                     'food_ingredients','food_featured','restaurant_food_id');
        // $log_data['food_images']  = $files_name;
        // $log_data['food_role']    = $user_role;
        // $log_data['food_operation_performed']  = "UPDATE";
        // $log_data['restaurant_food_id']        = $id;
        $res = $this->restaurantFoodRepo->update($data, $id);
        if($res['status'] && isset($res['restaurant'])){
            $restaurantLog = $res['restaurant']->toArray();
            $restaurantLog['food_operation_performed'] = "UPDATE";
            $result = $this->restaurantFoodRepo->createRestaurantLogs($restaurantLog);
        }
        return $res;
    }

    public function activeOrInactive($request)
    {
        $action_perform = $request->action_perform;
        $id = $request->restaurant_food_id;
        $log_data = '1';
        $message = 'Status Could not change!';
        if($action_perform == "active"){
            $data['food_status'] = 1;
            $message = 'Selected Supplier has been Activated.';
        }elseif($action_perform == "inactive"){
            $data['food_status'] = 0;
            $message = 'Selected Supplier has been Inactivated.';
        }else{
            return['status' => false, 'message' => $message];
        }
        $res = $this->restaurantFoodRepo->update($data, $id);
        if($res['status'] && isset($res['restaurant'])){
            $restaurantLog = $res['restaurant']->toArray();
            $restaurantLog['food_operation_performed'] = $action_perform;
            $result = $this->restaurantFoodRepo->createRestaurantLogs($restaurantLog);
        }
        return $res;
    }

    public function food_details($food_id)
    {
        if (session()->has('travel_users_id')) {
            // $rights = $this->rights('food-management');
            $emp_id = session()->get('travel_users_id');
                $get_food = RestaurantFood::where('restaurant_food_id', $food_id)->where('food_created_by', $emp_id)->where('food_role', '!=', 'Supplier')->first();
            if (!empty($get_food)) {
                $fetch_restaurants = Restaurants::get();
                $menu_categories = RestaurantMenuCategory::get();

                return view('mains.restaurant-food-detail-view')->with(compact('get_food', 'fetch_restaurants', 'menu_categories'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->route('index');
        }
    }

}




?>
