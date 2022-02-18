<?php
namespace App\Repositories;
use App\Models\Restaurants;
use App\Models\Restaurants_log;
use Exception;
use PhpParser\Node\Stmt\TryCatch;

class RestaurantManagementRepository{
    public function __construct(Restaurants $RestaurantManagementRepository){
        $this->RestaurantManagementRepository = $RestaurantManagementRepository;
    }

    public function store($data){
        try {
            $res = $this->RestaurantManagementRepository->create($data)->id;
            return ['status' => true, 'response'=>$res];
        } catch (Exception $e) {
            return ['status' => false, 'response'=>$e];
        }
    }


    public function update($data,$id){
        try{
            $restaurant = Restaurants::where('id',$id)->update($data);
            return ['status' => true, 'response'=>$restaurant];
        }catch(Exception $e){
            return ['status' => false, 'response'=>$e];
        }
    }

    public function updateDrafted($data,$id){
        try{
            $restaurant = Restaurants::where('id',$id)->update($data);
            return ['status' => true, 'response'=>$restaurant];
        }catch(Exception $e){
            return ['status' => false, 'response'=>$e];
        }
    }
    public function changeStatus($id, $column, $bool){
        try{
            if($this->RestaurantManagementRepository->where('id',$id)->firstOrFail()->drafted_status == 0){
                $this->RestaurantManagementRepository->where('id', $id)->update([$column => $bool]);
                $subject_status= ($bool == 1 ? 'activated' : 'inactivated');
                return ['title' => 'Success', 'subject' => $subject_status, 'type' => 'success'];
            }
            else{
                return ['title' => 'Error', 'subject' => 'Drafted restaurant '.$column.' can\'t be changed', 'type' => 'warning'];
            }
        }
        catch(\Exception $err){
            return ['title' => 'Failed' ,'subject' => 'Fail to '. $bool == 1 ? 'activated ' : 'inactivated '.$column. ' due to '.$err->getMessage(), 'type' => 'error'];
        }
    }

}

?>
