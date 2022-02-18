<?php

namespace App\Repositories;

use App\Models\RestaurantMenuCategory;
use App\Services\RestaurantMenuService;
use Exception;

class RestaurantMenuRepository{
    public function __construct(RestaurantMenuCategory $RestaurantMenuRepository){
        $this->RestaurantMenuRepository = $RestaurantMenuRepository;
    }

    public function store($data){
        try{
            $this->RestaurantMenuRepository->create($data);
            return 1;
        }catch(Exception $e){
            return 0;
        }
        
    }
    public function update($data, $id){;
        try{
            $this->RestaurantMenuRepository->find($id)->update($data);
            return 1;
        }catch(Exception $e){
            return 0;
        }
        
    }
}



?>
