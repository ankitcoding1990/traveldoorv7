<?php
namespace App\Services;

use App\Repositories\HotelManagementRepository;

Class HotelManagementService
{
    public function __construct(HotelManagementRepository $hotelManagementRepository)
    {
        $this->repo = $hotelManagementRepository;
    }
    public function store($request, $id = null)
    {
        $data = $request->only( 'hotel_name', 'hotel_type_id', 'supplier_id', 'hotel_contact', 'location', 'hotel_rating', 'country_id', 'city_id', 'currency_id','booking_validity_from','booking_validity_to','blackout_dates','description', 'created_admin_id');
        if($id != null){
            return $this->repo->update($data, $id);
        }
        return $this->repo->store($data);
    }
    public function amenitiesStore($request,$id){
        $policy = $request->only('reasons_to_book','other_policies');
        $amenity = $request->only('hotel');
        return $this->repo->storeAmenities($policy, $amenity, $id);
    }
    public function descriptionUpdate($request,$id){
        $data = $request->only('admin_approval', 'draft_status', 'status', 'cancel_policy','terms_conditions', 'confirm_message');
        if (auth()->user()) {
            $data['admin_approval'] = 1;
        } else {
            $data['admin_approval'] = 0;
        }
        $data['draft_status'] = 0;
        $data['status'] = 1;
        return $this->repo->updateDescription($data,$id);
    }
    public function changeState($id, $column, $bool)
    {
        return $this->repo->changeState($id, $column, $bool);
    }
    public function delete($id)
    {
        return $this->repo->delete($id);
    }
}

