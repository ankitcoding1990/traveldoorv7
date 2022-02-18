<?php
namespace App\Services;

use App\Repositories\HotelMealRepository;

class HotelMealService {

    public function __construct(HotelMealRepository $repo)
    {
        $this->repo = $repo;
    }

    public function store($request, $id = null)
    {
        $data = $request->only('hotel_meals_name','hotel_meals_created_by');
        if($id != null){
            return $this->repo->update($data, $id);
        }
        return $this->repo->insert($data);
    }

    public function ChangeState($request)
    {
        return $this->repo->ChangeState($request->id, $request->state);
    }

    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}
