<?php
namespace App\Services;

use App\Models\FuelType;
use App\Repositories\SightseeingManagementRepository;

Class SightseeingManagementServices
{
    public function __construct(SightseeingManagementRepository $SightseeingManagementRepository)
    {
        $this->SightseeingManagementRepository = $SightseeingManagementRepository;
    }
    public function store($request)
    {
        $data = $request->only('tour_name', 'tour_type', 'tour_desc', 'country_id', 'city_covered', 'from_city_id', 'city_between_ids', 'to_city_id', 'distance_covered', 'duration', 'fuel_type_id', 'food_cost', 'hotel_cost', 'adult_cost', 'child_cost', 'default_guide_price', 'additional_cost','from_date', 'to_date','discount', 'surge', 'no_of_pax', 'default_driver_price', 'attractions', 'created_admin_id', 'created_supplier_id', 'show_order', 'status', 'best_status', 'popular_status');
        return $this->SightseeingManagementRepository->updateStore($data);
    }
    public function update($request, $id)
    {
        $data = $request->only('tour_name', 'tour_type', 'tour_desc', 'country_id', 'city_covered', 'from_city_id', 'city_between_ids', 'to_city_id', 'distance_covered', 'duration', 'fuel_type_id', 'food_cost', 'hotel_cost', 'adult_cost', 'child_cost', 'group_adult_cost', 'group_child_cost', 'group_max_pax', 'group_tour_terms', 'default_guide_price', 'additional_cost','from_date', 'to_date','discount', 'surge', 'no_of_pax', 'default_driver_price', 'attractions',  'created_admin_id', 'created_supplier_id', 'show_order', 'status', 'best_status', 'popular_status');
        return $this->SightseeingManagementRepository->updateStore($data, $id);
    }
    public function storePricing($request, $id){
        $data = $request->only('group_adult_cost', 'group_child_cost', 'group_max_pax', 'group_tour_terms');
        return $this->SightseeingManagementRepository->updatePricing($data, $id);
    }
    public function storeDescription($request, $id){
        $data = $request->only('attractions', 'tour_desc','draft_status', 'status', 'admin_approval');
        if(auth()->user()){
            $data['admin_approval'] = 1;
        }else{
            $data['admin_approval'] = 0;
        }
        $data['draft_status'] = 0;
        $data['status'] = 1;
        return $this->SightseeingManagementRepository->updateDescription($data, $id);
    }

    public function publish($request, $id){
        $data = $request->only('status');
        $data['status'] = 1;
        return $this->SightseeingManagementRepository->publish($data, $id);
    }
    public function changeState($id, $column, $bool)
    {

        return $this->SightseeingManagementRepository->changeState($id, $column, $bool);
    }
    public function delete($id)
    {
        return $this->SightseeingManagementRepository->delete($id);
    }
}
