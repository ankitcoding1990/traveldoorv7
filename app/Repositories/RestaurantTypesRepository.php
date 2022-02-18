<?php

namespace App\Repositories;

use App\Models\RestaurantType;
use Exception;

class RestaurantTypesRepository
{
    protected $restaurantType;
    function __construct(RestaurantType $restaurantType){
        $this->restaurantType = $restaurantType;
    }

    function store($data){
            try{
                $this->restaurantType->create($data);
                return 1;
            }catch(Exception $e){
                return 0;

            }

    }
    function update($data){
            try{
                $this->restaurantType->find($data['id'])->update($data);
                 return 1;
            }catch(Exception $e){
                return 0;
            }
    }

}


?>
